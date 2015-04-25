<?php


namespace USGS;


class Detail extends USGS
{
    public function getDetail($id)
    {
        $this->addParams(
            [
                'format' => 'geojson',
                'eventid' => $id,
            ]
        );

        $this->setAction('query');

        return $this->load();
    }
}
