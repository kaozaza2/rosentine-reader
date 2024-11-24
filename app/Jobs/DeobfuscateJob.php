<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;
use Illuminate\Process\Exceptions\ProcessFailedException;

class DeobfuscateJob implements ShouldQueue
{
    use Queueable;

    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::channel('deobfuscate')->info('Starting the deobfuscation process.');

        $output = $this->deobfuscate($this->code);

        [$url, $patterns] = $this->extract($output);

        Log::channel('deobfuscate')->info('Deobfuscation process completed.');
    }

    /**
     * Deobfuscate the code using Node.js.
     *
     * @param string $code
     * @return string
     */
    private function deobfuscate($code)
    {
        $tempFilePath = tempnam(sys_get_temp_dir(), 'js_') . '.js';
        file_put_contents($tempFilePath, 'console.log' . substr($code, 4));

        try {
            return Process::run("node $tempFilePath")
                ->throw()
                ->output();
        } catch (ProcessFailedException $e) {
            Log::channel('deobfuscate')->error("Node.js execution failed: {$e->getMessage()}");
            throw $e;
        } finally {
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }
    }

    /**
     * Extract the URL and Pattern from the given JavaScript code.
     *
     * @param string $code
     * @return array
     */
    private function extract($code)
    {
        preg_match('/src=[\'"](.*?)[\'"]/', $code, $urlMatch);
        $extractedUrl = $urlMatch[1] ?? '';

        preg_match_all('/\["(.*?)","(.*?)","(.*?)","(.*?)"\]/', $code, $patternMatches);

        $columns = array_unique($patternMatches[1]);
        $rows = array_unique($patternMatches[2]);
        
        sort($columns);
        sort($rows);

        $columns = array_flip($columns);
        $rows = array_flip($rows);

        $patterns = array_map(function ($toCol, $toRow, $fromCol, $fromRow) use ($columns, $rows) {
            return "{$columns[$toCol]},{$rows[$toRow]},{$columns[$fromCol]},{$rows[$fromRow]}";
        }, $patternMatches[1], $patternMatches[2], $patternMatches[3], $patternMatches[4]);

        Log::channel('deobfuscate')->debug("Extracted URL: $extractedUrl, Pattern: " . implode('|', $patterns));
        
        return [$extractedUrl, implode('|', $patterns)];
    }
}
