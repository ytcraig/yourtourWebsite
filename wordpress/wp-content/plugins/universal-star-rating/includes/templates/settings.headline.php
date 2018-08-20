<?php
/**
 * Template file for USR header
 *
 * @author Chasil
 * @author Mike Wigge <info@universal-star-rating.de>
 *
 * @since 2.0
 * @version 1.1
 */
?>

<div id="usrHeadline" class="wrap">
    <h2><?php echo $usr->getPluginName();?></h2>

	<?php
    $whitelistTabs = array('description', 'settings', 'preview_examples');
	if(isset($_GET['tab']) && in_array($_GET['tab'], $whitelistTabs)) {
		$activeTab = $_GET['tab'];
	} else {
		$activeTab = 'settings';
    }
	?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo $usr->getMenuSlugName(); ?>&tab=description" class="nav-tab <?php echo $activeTab == 'description' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Description', 'universal-star-rating'); ?></a>
        <a href="?page=<?php echo $usr->getMenuSlugName(); ?>&tab=settings" class="nav-tab <?php echo $activeTab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Settings', 'universal-star-rating'); ?></a>
        <a href="?page=<?php echo $usr->getMenuSlugName(); ?>&tab=preview_examples" class="nav-tab <?php echo $activeTab == 'preview_examples' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Preview / Examples', 'universal-star-rating'); ?></a>
    </h2>
</div>