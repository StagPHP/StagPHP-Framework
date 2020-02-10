/* A polyfill for browsers that don't support ligatures. */
/* The script tag referring to this file must be placed before the ending body tag. */

/* To provide support for elements dynamically added, this script adds
   method 'icomoonLiga' to the window object. You can pass element references to this method.
*/
(function () {
    'use strict';
    function supportsProperty(p) {
        var prefixes = ['Webkit', 'Moz', 'O', 'ms'],
            i,
            div = document.createElement('div'),
            ret = p in div.style;
        if (!ret) {
            p = p.charAt(0).toUpperCase() + p.substr(1);
            for (i = 0; i < prefixes.length; i += 1) {
                ret = prefixes[i] + p in div.style;
                if (ret) {
                    break;
                }
            }
        }
        return ret;
    }
    var icons;
    if (!supportsProperty('fontFeatureSettings')) {
        icons = {
            'done': '&#xe876;',
            'priority_high': '&#xe645;',
            'refresh': '&#xe5d5;',
            'error': '&#xe000;',
            'error_outline': '&#xe001;',
            'report_problem': '&#xe002;',
            'warning': '&#xe002;',
            'video_library': '&#xe04a;',
            'web': '&#xe051;',
            'art_track': '&#xe060;',
            'add_box': '&#xe146;',
            'content_copy': '&#xe14d;',
            'report': '&#xe160;',
            'font_download': '&#xe167;',
            'insert_drive_file': '&#xe24d;',
            'cloud_download': '&#xe2c0;',
            'backup': '&#xe2c4;',
            'cloud_upload': '&#xe2c4;',
            'file_upload': '&#xe2c6;',
            'keyboard_arrow_down': '&#xe313;',
            'keyboard_arrow_left': '&#xe314;',
            'keyboard_arrow_up': '&#xe316;',
            'memory': '&#xe322;',
            'security': '&#xe32a;',
            'dehaze': '&#xe3c7;',
            'chevron_right': '&#xe409;',
            'navigate_next': '&#xe409;',
            'picture_as_pdf': '&#xe415;',
            'tune': '&#xe429;',
            'layers': '&#xe53b;',
            'local_mall': '&#xe54c;',
            'arrow_back': '&#xe5c4;',
            'arrow_forward': '&#xe5c8;',
            'cancel': '&#xe5c9;',
            'clear': '&#xe5cd;',
            'close': '&#xe5cd;',
            'more_vert': '&#xe5d4;',
            'arrow_upward': '&#xe5d8;',
            'arrow_downward': '&#xe5db;',
            'notifications': '&#xe7f4;',
            'notifications_active': '&#xe7f7;',
            'person': '&#xe7fd;',
            'check_box': '&#xe834;',
            'account_box': '&#xe851;',
            'build': '&#xe869;',
            'check_circle': '&#xe86c;',
            'dashboard': '&#xe871;',
            'help': '&#xe887;',
            'launch': '&#xe89e;',
            'open_in_new': '&#xe89e;',
            'perm_media': '&#xe8a7;',
            'search': '&#xe8b6;',
            'settings': '&#xe8b8;',
            'local_grocery_store': '&#xe8cc;',
            'shopping_cart': '&#xe8cc;',
            'verified_user': '&#xe8e8;',
            'view_list': '&#xe8ef;',
            'remove_red_eye': '&#xe8f4;',
            'visibility': '&#xe8f4;',
            'visibility_off': '&#xe8f5;',
            'help_outline': '&#xe8fd;',
            'indeterminate_check_box': '&#xe90b;',
          '0': 0
        };
        delete icons['0'];
        window.icomoonLiga = function (els) {
            var classes,
                el,
                i,
                innerHTML,
                key;
            els = els || document.getElementsByTagName('*');
            if (!els.length) {
                els = [els];
            }
            for (i = 0; ; i += 1) {
                el = els[i];
                if (!el) {
                    break;
                }
                classes = el.className;
                if (/stag-ico/.test(classes)) {
                    innerHTML = el.innerHTML;
                    if (innerHTML && innerHTML.length > 1) {
                        for (key in icons) {
                            if (icons.hasOwnProperty(key)) {
                                innerHTML = innerHTML.replace(new RegExp(key, 'g'), icons[key]);
                            }
                        }
                        el.innerHTML = innerHTML;
                    }
                }
            }
        };
        window.icomoonLiga();
    }
}());
