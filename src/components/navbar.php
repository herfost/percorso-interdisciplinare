<!-- 
    $links = array(
        array(
            'name' => ..., 
            'href' => ...
        ),
        ...
    );
-->

<navbar class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
                <ul class="flex flex-row font-medium mt-0 mr-6 space-x-8 text-sm">
                    <? foreach ($links as $link): ?>
                        <li><a href="<? echo $link['href']; ?>" class="text-black hover:underline"><? echo $link['name']; ?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</navbar>