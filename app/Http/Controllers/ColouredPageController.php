<?php

namespace App\Http\Controllers;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ColouredPageController extends Controller
{
    /**
     * Pass a colour to the view
     *
     * @return Factory|View
     */
    public function index()
    {
        try {
            $client = new \GuzzleHttp\Client(['base_uri' => 'https://go.trustvet.com/api/']);
            $request = $client->request('GET', 'test');
            $response = json_decode($request->getBody()->getContents());
            $colour = $response->colour;
        } catch (ServerException $exception) {
            if ($exception->hasResponse()) {
                $colour = '#ffffff';
            }
        }

        return View('pages.coloured_page.index', compact('colour'));
    }
}
