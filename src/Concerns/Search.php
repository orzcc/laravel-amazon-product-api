<?php

namespace Orzcc\Amazon\ProductAdvertising\Concerns;

use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\PartnerType;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResponse;
use Illuminate\Support\Facades\Config;

trait Search
{
    /**
     * {@inheritdoc}
     */
    public function search(string $category, string $keyword = null, int $page = 1, array $searchOptions = [])
    {
        /**
         * @var SearchItemsResource[] $resources
         */
        $resources = SearchItemsResource::getAllowableEnumValues();

        $request = new SearchItemsRequest();
        $request->setSearchIndex($category);
        $request->setKeywords($keyword);
        $request->setItemPage($page);
        if (isset($searchOptions['partnerTag'])) {
            $request->setPartnerTag($searchOptions['partnerTag']);
        } else {
            $request->setPartnerTag(Config::get('amazon-product.associate_tag'));
        }
        $request->setPartnerType(PartnerType::ASSOCIATES);
        if (isset($searchOptions['marketplace'])) {
            $request->setMarketplace($searchOptions['marketplace']);
        } else {
            $request->setMarketplace(Config::get('amazon-product.marketplace'));
        }
        if (isset($searchOptions['languagesOfPreference'])) {
            $request->setLanguagesOfPreference([$searchOptions['languagesOfPreference']]);
        }
        if (isset($searchOptions['currencyOfPreference'])) {
            $request->setCurrencyOfPreference($searchOptions['currencyOfPreference']);
        }
        $request->setResources($resources);

        // Other Search Options
        if (isset($searchOptions['actor'])) {
            $request->setActor($searchOptions['actor']);
        }
        if (isset($searchOptions['artist'])) {
            $request->setArtist($searchOptions['artist']);
        }
        if (isset($searchOptions['author'])) {
            $request->setAuthor($searchOptions['author']);
        }
        if (isset($searchOptions['availability'])) {
            $request->setAvailability($searchOptions['availability']);
        }
        if (isset($searchOptions['brand'])) {
            $request->setBrand($searchOptions['brand']);
        }
        if (isset($searchOptions['browseNodeId'])) {
            $request->setBrowseNodeId($searchOptions['browseNodeId']);
        }
        if (isset($searchOptions['condition'])) {
            $request->setCondition($searchOptions['condition']);
        }

        if (isset($searchOptions['deliveryFlags'])) {
            $request->setDeliveryFlags($searchOptions['deliveryFlags']);
        }
        if (isset($searchOptions['itemCount'])) {
            $request->setItemCount($searchOptions['itemCount']);
        }
        if (isset($searchOptions['maxPrice'])) {
            $request->setMaxPrice($searchOptions['maxPrice']);
        }
        if (isset($searchOptions['merchant'])) {
            $request->setMerchant($searchOptions['merchant']);
        }
        if (isset($searchOptions['minPrice'])) {
            $request->setMinPrice($searchOptions['minPrice']);
        }
        if (isset($searchOptions['minReviewsRating'])) {
            $request->setMinReviewsRating($searchOptions['minReviewsRating']);
        }
        if (isset($searchOptions['minSavingPercent'])) {
            $request->setMinSavingPercent($searchOptions['minSavingPercent']);
        }
        if (isset($searchOptions['offerCount'])) {
            $request->setOfferCount($searchOptions['offerCount']);
        }
        if (isset($searchOptions['properties'])) {
            $request->setProperties($searchOptions['properties']);
        }
        if (isset($searchOptions['sortBy'])) {
            $request->setSortBy($searchOptions['sortBy']);
        }
        if (isset($searchOptions['title'])) {
            $request->setTitle($searchOptions['title']);
        }

        $request = $this->callHook('search', $request);

        /**
         * @var SearchItemsResponse $response
         */
        $response = $this->api()->searchItems($request);

        return json_decode($response->__toString(), true);
    }
}
