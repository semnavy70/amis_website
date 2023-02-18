<?php if(!isset($innerLoop)): ?>
    <ul class="navbar-nav ml-auto menu_active">
<?php else: ?>
    <div class="dropdown-menu menu_active" aria-labelledby="navbarDropdownMenuLink">
<?php endif; ?>

    <?php

        $menu_slug = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $home_active = $menu_slug == '/' ? 'active' : '';

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    ?>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php

            //dd($options->locale);
            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $listItemClass = [];
            $linkAttributes =  null;
            $styles = null;
            $icon = null;
            $caret = null;

            $href = $item->link();

            // Current page
            if(app_url($href) == url($menu_slug))
            {
                array_push($listItemClass, 'active');
            }

            // Background Color or Color
            
            if (isset($options->color) && $options->color == true) {
                $styles = 'color:'.$item->color;
            }
            if (isset($options->background) && $options->background == true) {
                $styles = 'background-color:'.$item->color;
            }

            // With Children Attributes
            /*if(!$originalItem->children->isEmpty()) {
                // $linkAttributes =  'nav-link dropdown-toggle';
                $linkAttributes =  'class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                $caret = '<span class="sr-only"></span>';

                if(url($item->link()) == url()->current()){
                    $listItemClass = "nav-item dropdown menu_active";
                }else{
                    $listItemClass = "nav-item dropdown menu_active";
                }
            }*/

            $hasChildren = false;
            if(!$item->children->isEmpty())
            {
                foreach($item->children as $child)
                {
                    // $hasChildren = $hasChildren || Auth::user()->can('browse', $child);

                    if(app_url($child->link()) == url($menu_slug))
                    {
                        array_push($listItemClass, 'active');
                    }
                }
                // if (!$hasChildren) {
                //     continue;
                // }

                $linkAttributes ='class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                array_push($listItemClass, 'nav-item dropdown');
            }
            else
            {
                $linkAttributes =  'href="' . url($href) .'" class="nav-link"';

                // if(!Auth::user()->can('browse', $item)) {
                //     continue;
                // }
            }

            // Set Icon
            if(isset($options->icon) && $options->icon == true){
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        ?>
        <?php if(!isset($innerLoop)): ?>   
            
            <li class="nav-item <?php echo e(implode(" ", $listItemClass)); ?>">
                <a href="<?php echo e(app_url($item->link())); ?>" target="<?php echo e($item->target); ?>" style="<?php echo e($styles); ?>" <?php echo isset($linkAttributes) ? $linkAttributes : ''; ?>>
                    <?php echo $icon; ?>

                    <span><?php echo e($item->title); ?></span>
                    <?php echo $caret; ?>

                </a>
                <?php if(!$originalItem->children->isEmpty()): ?>
                    <?php echo $__env->make('share.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            </li>
            <?php if($loop->last): ?>
            <li class="nav-item">
                <a class="nav-link icon search" id="search" href="#">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <?php endif; ?>
        <?php else: ?>
            <a class="dropdown-item" href="<?php echo e(app_url($item->link())); ?>">
                <?php echo $icon; ?>

                <span><?php echo e($item->title); ?></span>
                
            </a>
            <?php if(!$originalItem->children->isEmpty()): ?>
                <?php echo $__env->make('share.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php if(!isset($innerLoop)): ?>
    </ul>
<?php else: ?>
    </div>
<?php endif; ?>