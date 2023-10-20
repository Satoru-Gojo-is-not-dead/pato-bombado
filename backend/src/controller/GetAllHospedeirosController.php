<?php

namespace src\controller;

use src\dao\HospedeiroDao;

class GetAllHospedeirosController
{
    private HospedeiroDao $hospedeiroDao;

    public function __construct(HospedeiroDao $hospedeiroDao)
    {
        $this->hospedeiroDao = $hospedeiroDao;
    }

    public function getAllHospedeiros(): array
    {
        try {
            $hospedeiros = $this->hospedeiroDao->getAllHospedeiros();

            return $hospedeiros;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
