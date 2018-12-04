<?php declare(strict_types=1);

namespace src\components\Render;

class Render implements RenderInterface
{
    /**
     * @param string $_file_
     * @param array $_params_
     * @return string
     */
    public function renderPhpFile($_file_, array $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(0);
        extract($_params_);
        require($_file_);

        return ob_get_clean();
    }
}


