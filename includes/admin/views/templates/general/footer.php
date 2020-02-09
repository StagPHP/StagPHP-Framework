<?php
/**
 * @package:        m_framework
 * Name:            Home Page
 */

/** CYZ VR: View Resources */
$resource_dir = get_assets_dir_uri(NULL, TRUE); ?>


<!--Footer-->
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/jquery.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/vendor/bootstrap/js/bootstrap.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/hammer.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/smooth-scrollbar.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/dragula.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/jquery.form.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/jquery.cookie.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/components/slick.min.js'; ?>"></script>

<?php if(defined('SLUG_ARRAY')): if(!empty(SLUG_ARRAY[1])): ?>

<script type="text/javascript" src="<?php echo $resource_dir.'/js/build/'.SLUG_ARRAY[1].'.js'; ?>"></script>
<?php endif; else: ?>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/build/dashboard.js'; ?>"></script>
<?php endif; ?>

<!-- Main Build CSS -->
<script type="text/javascript" src="<?php echo $resource_dir.'/js/ui-functions.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $resource_dir.'/js/main.js'; ?>"></script>

</body>
</html>
