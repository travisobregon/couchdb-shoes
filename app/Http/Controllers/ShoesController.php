<?php

namespace App\Http\Controllers;

use App\ShoesDesignDocument;
use Illuminate\Http\Request;
use Doctrine\CouchDB\CouchDBClient;
use Doctrine\CouchDB\HTTP\HTTPException;

class ShoesController extends Controller
{
    private $client;

    public function __construct() {
        $this->client = CouchDBClient::create(['dbname' => 'shoes']);

        try {
            $this->client->createDatabase($this->client->getDatabase());
        } catch (HTTPException $exception) {
            info('Database already exists.');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allShoes = collect($this->client->allDocs()->body['rows'])
            ->map(function ($row) {
                if ($row['id'] != '_design/shoes') {
                    return $row['doc'];
                }
            })
            ->filter(function ($doc) {
                return ! is_null($doc);
            })
            ->toArray();
            
        $this->client->createDesignDocument('shoes', new ShoesDesignDocument());
        
        $query = $this->client->createViewQuery('shoes', 'on_sale');
        $query->setIncludeDocs(true);
        $onSaleShoes = array_map(function ($row) {
            return $row['doc'];
        }, $query->execute()->toArray());

        $query = $this->client->createViewQuery('shoes', 'popular_vendor_shoes');
        $query->setReduce(true);
        $query->setGroupLevel(1);
        $popularVendorShoes = $query->execute()->toArray();
        usort($popularVendorShoes, function ($a, $b) {
            return $b['value'] - $a['value'];
        });

        $query = $this->client->createViewQuery('shoes', 'most_money_made_shoes');
        $mostMoneyMadeShoes = $query->execute()->toArray();
        usort($mostMoneyMadeShoes, function ($a, $b) {
            return $b['value'] - $a['value'];
        });

        $query = $this->client->createViewQuery('shoes', 'most_pairs_available_shoes');
        $query->setReduce(true);
        $query->setGroupLevel(1);
        $mostPairsAvailableShoes = $query->execute()->toArray();
        usort($mostPairsAvailableShoes, function ($a, $b) {
            return $b['value'] - $a['value'];
        });
        
        return view('shoes.index', compact('allShoes', 'onSaleShoes', 'popularVendorShoes', 'mostMoneyMadeShoes', 'mostPairsAvailableShoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = $request->only('date_released', 'gender');

        $document['_id'] = $request->sku;
        $document['quantity_sold'] = (int) $request->quantity_sold;
        $document['price'] = (float) $request->price;
        $document['vendor'] = [
            'name' => $request->vendor_name,
            'website' => $request->vendor_website
        ];
        $document['inventory'] = collect($request->only('sizes', 'counts'))
            ->transpose()
            ->map(function ($inventoryData) {
                return [
                    'size' => $inventoryData[0],
                    'count' => (int) $inventoryData[1]
                ];
            })->toArray();
        $document['on_sale'] = !! $request->on_sale;

        try {
            $this->client->postDocument($document);

            flash($request->sku.' was added successfully!', 'success');
        } catch (HTTPException $exception) {
            flash($request->sku.' already exists!', 'danger');
        }

        return redirect('shoes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shoe = $this->client->findDocument($id)->body;

        return view('shoes.edit', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $rev
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $rev)
    {
        $document = $request->only('date_released', 'gender');

        $document['quantity_sold'] = (int) $request->quantity_sold;
        $document['price'] = (float) $request->price;
        $document['vendor'] = [
            'name' => $request->vendor_name,
            'website' => $request->vendor_website
        ];
        $document['inventory'] = collect($request->only('sizes', 'counts'))
            ->transpose()
            ->map(function ($inventoryData) {
                return [
                    'size' => $inventoryData[0],
                    'count' => (int) $inventoryData[1]
                ];
            })->toArray();
        $document['on_sale'] = !! $request->on_sale;

        try {
            $this->client->putDocument($document, $id, $rev);

            flash($id.' was updated successfully!', 'success');
        } catch (HTTPException $exception) {
            flash('Failed to update '.$id.'!', 'danger');       
        }

        return redirect('shoes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $rev
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $rev)
    {
        try {
            $this->client->deleteDocument($id, $rev);

            flash($id.' was deleted successfully!', 'success');
        } catch (HTTPException $exception) {
            flash('Failed to delete '.$id.'!', 'danger');
        }

        return redirect('shoes');
    }
}
