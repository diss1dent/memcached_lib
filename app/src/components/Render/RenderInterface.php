<?php declare(strict_types=1);

namespace src\components\Render;

interface RenderInterface
{
    /**
     * @param $_file_
     * @param array $_params_
     * @return mixed
     */
    public function renderPhpFile($_file_, array $_params_);
}