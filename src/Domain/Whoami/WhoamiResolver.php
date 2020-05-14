<?php

/**
 * © Infostrates
 * Par Julien
 * Le 14/05/2020
 */

declare(strict_types=1);

namespace App\Domain\Whoami;

use App\Domain\Whoami\Models\Person;
use App\Domain\Whoami\Models\Whoami;

final class WhoamiResolver
{
    public function getWhoami(): Whoami
    {
        $me = new Person('Gaertner', 'Julien', 'jugaert@protonmail.com', '44B rue Kruger 13004 Marseille', '0666016789');
        $content = '
                <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse nec placerat turpis. Maecenas eu felis at turpis malesuada egestas. In quis felis quis urna suscipit aliquam sed
            interdum orci. Sed porta in ex eget auctor. Duis egestas, neque et maximus viverra, tellus metus bibendum mi, sit amet lobortis elit mi ut nisl. Sed vel erat a ante convallis euismod.
            Fusce venenatis, elit at laoreet fringilla, ante nunc iaculis orci, eget suscipit mauris urna id tortor. Proin mattis et massa ac hendrerit. Maecenas eu finibus turpis. Ut vel lorem
            efficitur, ornare metus nec, porta ligula.
        </p>
        <p>
            Morbi vestibulum aliquet est, eu placerat risus imperdiet eget. Praesent id ex rhoncus, hendrerit nunc nec, porta mauris. Phasellus ut elit leo. Donec a pellentesque dui. Etiam aliquet
            sapien eu tristique malesuada. Pellentesque leo elit, malesuada ac dolor eget, rhoncus efficitur metus. Quisque accumsan mauris eget velit pellentesque, sed ultrices erat consequat.
            Vestibulum posuere mollis mi eu eleifend. Donec pellentesque, dui at volutpat iaculis, quam odio efficitur turpis, et ultricies nulla ante vel justo. In euismod leo sed elit cursus
            sollicitudin. Vestibulum tempor tortor a nibh malesuada luctus. Vestibulum volutpat molestie ultricies. Sed sed ligula condimentum, porttitor nisi sed, rutrum erat. Nullam semper in est in
            egestas. In hac habitasse platea dictumst. Nullam venenatis metus sed sapien venenatis, non gravida mi placerat.
        </p>
        ';

        return new Whoami($me, $content);
    }
}
