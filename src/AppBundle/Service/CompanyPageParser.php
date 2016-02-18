<?php

namespace AppBundle\Service;

use Symfony\Component\DomCrawler\Crawler;

class CompanyPageParser implements PageParser
{
    /**
     * @param $html
     * @return array
     */
    public function parse($html)
    {
        $crawler = new Crawler($html);

        $employees = $crawler
            ->filter('.person_link strong')
            ->each(function (Crawler $crawler) {
                return [
                    'name' => trim($crawler->text())
                ];
            });

        $facts = $crawler
            ->filter('.company-facts-data tr')
            ->each(function (Crawler $crawler) {
                return [
                    'title' => trim($crawler->filter('th')->text()),
                    'text' => trim($crawler->filter('td')->text()),
                ];
            });

        return [
            'employees' => $employees,
            'facts' => $facts,
        ];
    }
}