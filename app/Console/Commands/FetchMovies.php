<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class FetchMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://the-one-api.dev/v2/',
            'headers' => [
                'Authorization' => 'Bearer BeX5hWLoZUmDg_wIrwAK',
                'Content-Type' => 'application/json'
            ]
        ]);

        $page = 1;
        while ($page <= 3) {
            $response = $client->request('GET', 'movie', [
                'query' => [
                    'page' => $page
                ]
            ]);
            /*$response = Http::withHeaders([
                    'Authorization' => 'Bearer BeX5hWLoZUmDg_wIrwAK',
                    'Content-Type' => 'application/json'
                ])->get('https://the-one-api.dev/v2/movies');*/

            $movies = json_decode($response->getBody(), true)['docs'];

            foreach ($movies as $movie) {
                $existingMovie = Movie::where('name', $movie['name'])->first();

                if (!$existingMovie) {
                    Movie::create([
                        'name' => $movie['name'],
                        'BudgetInMillions' => $movie['budgetInMillions'],
                    ]);
                }
                echo 'Movies saved to database!';
                print_r("\n");
            }

            $page++;
        }

        return Command::SUCCESS;
    }
}
