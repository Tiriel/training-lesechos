<?php

namespace App\Templating\Views;

class MainIndexView extends BaseView
{
    protected function doGetContext(): array
    {
        $context = parent::doGetContext();

        return array_merge($context, [
            '_blockHeader' => $context['_blockHeader'] . <<<HEADER
    <section class="bg-black p-5">
        <div class="text-center">
            <h1 class="display-3 font-weight-bold m-0">Test OOP PHP Project</h1>
        </div>
    </section>
HEADER,
            '_blockFooter' => '',
        ]);
    }

}
