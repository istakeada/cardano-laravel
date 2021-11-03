<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class Cardano extends Controller
{
        
    /**
     * Blockfrost Url Request Constructor
     *
     * @param  string testnet | mainnet
     * @param  string $main
     * @param  string $id
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    private function query($network, $main, $id, $param1, $param2)
    {
        switch ($network) {
            case 'mainnet':
                $project_id = env('MAINNET');
            break;
            case 'testnet':
                $project_id = env('TESTNET');
            break;
            default:
                return response(['message' => 'Network not supported']);
        }

        return Http::withHeaders(['project_id' => $project_id])
            ->get('https://cardano-' . $network . '.blockfrost.io/api/v0/' . $main. '/' . $id . '/' . $param1 . '/' . $param2);

    }
    
    /**
     * Accounts Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $account
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    public function accounts($network, $account, $param1 = null, $param2 = null)
    {
        return $this->query($network, 'accounts', $account, $param1, $param2);
    }
    
    /**
     * Addresses Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $address
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    public function addresses($network, $address, $param1 = null, $param2 = null)
    {
        return $this->query($network, 'address', $address, $param1, $param2);
    }
    
    /**
     * Assets Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $asset
     * @param  string parameter 1
     * @return void
     */
    public function assets($network, $asset = null, $param1 = null)
    {
        return $this->query($network, 'assets', $asset, $param1, null);
    }
    
    /**
     * Blocks Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $block
     * @param  string parameter 1
     * @return void
     */
    public function blocks($network, $block = null, $param1 = null)
    {
        return $this->query($network, 'blocks', $block, $param1, null);
    }
    
    /**
     * Epochs Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $epoch
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    public function epochs($network, $epoch, $param1 = null, $param2 = null)
    {
        return $this->query($network, 'epochs', $epoch, $param1, $param2);
    }
    
    /**
     * Ledger Endpoint
     *
     * @param  string testnet | mainnet
     * @return void
     */
    public function ledger($network)
    {
        return $this->query($network, 'genesis', null, null, null);
    }
    
    /**
     * Metadata Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $label
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    public function metadata($network, $label = null, $param1 = null, $param2 = null)
    {
        return $this->query($network, 'metadata/txs/labels', $label, $param1, $param2);
    }
    
    /**
     * Network Endpoint
     *
     * @param  string testnet | mainnet
     * @return void
     */
    public function network($network)
    {
        return $this->query($network, 'network', null, null, null);
    }
    
    /**
     * Pools Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $pool
     * @param  string parameter 1
     * @return void
     */
    public function pools($network, $pool = null, $param1 = null)
    {
        return $this->query($network, 'pools', $pool, $param1, null);
    }
    
    /**
     * Scripts Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $script
     * @param  string parameter 1
     * @return void
     */
    public function scripts($network, $script = null, $param1 = null)
    {
        return $this->query($network, 'scripts', $script, $param1, null);
    }
    
    /**
     * Transactions Endpoint
     *
     * @param  string testnet | mainnet
     * @param  string $hash
     * @param  string parameter 1
     * @param  string parameter 2
     * @return void
     */
    public function transactions($network, $hash, $param1 = null, $param2 = null)
    {
        return $this->query($network, 'txs', $hash, $param1, $param2);
    }

}
