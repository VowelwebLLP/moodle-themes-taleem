<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The maintenance layout.
 *
 * @package   theme_taleem
 * @copyright 2018 VWThemes, vwthemes.com/lms-themes
 * @author    VWThemes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
<style type="text/css">
  .theme-slider, #front-page-carousel .carousel-item {
    height:600px;
  }

  .carousel-item-next.carousel-item-left,
  .carousel-item-prev.carousel-item-right {
    -webkit-transform: translateX(0);
    transform: translateX(0);
  }

  @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
    .carousel-item-next.carousel-item-left,
    .carousel-item-prev.carousel-item-right {
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }
  }

  .carousel-item-next,
  .active.carousel-item-right {
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
  }

  .carousel-item-prev,
  .active.carousel-item-left {
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
  }

  @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
    .carousel-item-next,
    .active.carousel-item-right {
      -webkit-transform: translate3d(100%, 0, 0);
      transform: translate3d(100%, 0, 0);
    }
  }

  @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
    .carousel-item-prev,
    .active.carousel-item-left {
      -webkit-transform: translate3d(-100%, 0, 0);
      transform: translate3d(-100%, 0, 0);
    }
  }

  .carousel-fade .carousel-item {
    opacity: 0;
    transition-duration: .6s;
    transition-property: opacity;
  }

  @supports ((-webkit-transform-style: preserve-3d) or (transform-style: preserve-3d)) {
    .carousel-fade .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item.active,
    .carousel-fade .active.carousel-item-left,
    .carousel-fade .active.carousel-item-prev {
      -webkit-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }
  }
  .titlebar {
        .slidenav {
            .nav-prev {
                float: right;
                i {
                    right: -1px;
                }
                .fa-chevron-left {
                    display: none;
                }
                .fa-chevron-right {
                    display: block;
                }
            }
            .nav-next {
                float: left;
                i {
                    left: -1px;
                }
                .fa-chevron-left {
                    display: block;
                }
                .fa-chevron-right {
                    display: none;
                }
            }
        }
        &.with-felements {
            h2 {
                float: right;
            }
            .slidenav {
                float: left;
            }
        }
    }
</style>

<?php
defined('MOODLE_INTERNAL') || die();

/**
 * slider.php
 * @return string
 */
function frontpage_slideshow() {
    global $PAGE;

    $taleemhomenumberofslidess = theme_taleem_get_setting('numberofslides');

    if ($taleemhomenumberofslidess) {
        $content = html_writer::start_tag('div', array('class' => 'frontpage-carousel'));
        $content .= html_writer::start_tag('div', array('id' => 'front-page-carousel',
         'class' => 'carousel slide', 'data-ride' => 'carousel'));

        $content .= html_writer::start_tag('div', array('class' => 'carousel-inner', 'role' => 'listbox'));
        for ($fs = 1; $fs <= $taleemhomenumberofslidess; $fs++):
            $taleemslidestatuss = ($fs == "1") ? ' active' : '';
            $taleemslideimg = theme_taleem_render_front_page_taleemslideimg($fs, 'slide' . $fs . 'image');
            $icon = "fa-angle-right";
            if (right_to_left()) {
                $icon = "fa-angle-left";
            }
            $content .= html_writer::start_tag('div', array('
                class' => 'carousel-item'.$taleemslidestatuss, 'style' => 'background-image: url('.$taleemslideimg));
            $content .= html_writer::end_tag('div');
        endfor;

        $content .= html_writer::start_tag('a', array('class' => 'left carousel-control carousel-control-prev', 'href' =>'#front-page-carousel', 'data-slide' => 'prev'));

        $content .= '<span class="carousel-control-prev-icon"></span>';
        $content .= html_writer::end_tag('a');

        $content .= html_writer::start_tag('a', array('class' => 'right carousel-control carousel-control-next',
         'href' => '#front-page-carousel', 'data-slide' => 'next'));
        $content .= '<span class="carousel-control-next-icon"></span>';
        $content .= html_writer::end_tag('a');

        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div');
    ?>
<?php

    }
    return $content;
}
echo frontpage_slideshow();