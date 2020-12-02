<?php

/**
 * Class Menu
 */
class Menu {
    /**
     * Menu constructor.
     * A biztonság kedvéért készült private láthatósággal, hogy biztosan ne lehessen példányosítani az osztályt.
     */
    private function __construct() {}

    /**
     * Visszaadja a megadott page id-jű oldalhoz tartozó tartalom elérési útját a szerveren.
     *
     * @param int $pageId
     *
     * @return string A tartalom elérési útja
     */
    public static function getContentPath(int $pageId)
    {
        $path = 'contents/404.php';

        $connection = Database::getConnection();
        $stmt = $connection->query("SELECT id, url FROM menu WHERE id=" . $pageId);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result) && file_exists('contents/' . $result['url'] . '.php')) {
            $path = 'contents/' . $result['url'] . '.php';
        }

        return $path;
    }

    /**
     * Visszaadja a menü HTML kódját beillesztésre készen.
     *
     * @param int $pageId           Az aktuális oldal id-je
     * @param int $userPermissionId Az aktuális felhasználó jogosultsági szintjének id-je
     *
     * @return string A menü fa teljes HTML kódja
     */
    public static function getMenu($pageId, $userPermissionId)
    {
        $menuItems = [];
        $menuHtml = [];

        $connection = Database::getConnection();
        $stmt = $connection->query("SELECT * FROM menu WHERE permission <= {$userPermissionId} ORDER BY position");
        while ($menuItem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $menuItems[$menuItem['id']] = $menuItem;
        }
        $menu = self::buildMenuTree($menuItems);

        $menuHtml[] = '<ul class="navbar-nav ml-auto">';
        foreach ($menu as $item) {
            $liExtraClass = '';
            $aExtraClass = '';
            $aExtraProperties = '';
            $href = '?pid=' . $item['id'];
            if (!empty($item['children'])) {
                $liExtraClass = 'dropdown';
                $aExtraClass = 'dropdown-toggle';
                $aExtraProperties = 'id="dropdown' . $item['id'] . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                $href = '#';
            }
            if ($item['id'] == $pageId || (!empty($item['children']) && array_key_exists($pageId, $item['children'])) ) {
                $liExtraClass .= ' active';
            }

            $menuHtml[] = '    <li class="nav-item ' . $liExtraClass . '">';
            $menuHtml[] = '     <a class="nav-link ' . $aExtraClass . '" href="' . $href . '" ' . $aExtraProperties . '>' . $item['name'] . '</a>';
            if (!empty($item['children'])) {
                $menuHtml[] = '         <div class="dropdown-menu" aria-labelledby="dropdown' . $item['id'] . '">';
                foreach ($item['children'] as $child) {
                    $dropdownExtraClass = '';
                    if ($child['id'] == $pageId) {
                        $dropdownExtraClass = ' active';
                    }
                    $menuHtml[] = '             <a class="dropdown-item ' . $dropdownExtraClass . '" href="?pid=' . $child['id'] . '">' . $child['name'] . '</a>';
                }
                $menuHtml[] = '         </div>';
            }
            $menuHtml[] = '    </li>';
        }
        $menuHtml[] = '</ul>';

        return empty($menuHtml) ? '' : implode("\n", $menuHtml);
    }

    /**
     * Visszaadja a menüelemek listájából hierarchikusan felépített tömböt (fát).
     *
     * @param array $elements
     * @param int   $parentId
     *
     * @return array A menü fa
     */
    protected static function buildMenuTree(array &$elements, $parentId = 0) {
        $tree = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildMenuTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $tree[$element['id']] = $element;
                unset($elements[$element['id']]);
            }
        }

        return $tree;
    }
}
