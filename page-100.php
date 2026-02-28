<?php 
/**
 * 关于爱情的100件事
 *
 * @package custom
 * @author  Flicker
 * @link    http://notemi.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>
    <header>
        <div class="container">
            <h1><?php $this->title() ?></h1>
            <p class="subtitle">100件关于爱情的小事</p>
        </div>
    </header>
    <div class="container">
        <style>
            /* 100 件事专用样式 */
            .hundred-list {
                font-size: 1.05rem;
                padding-right: 1.5rem;
                padding-left: 1.5rem;
                list-style: decimal;
            }
            .hundred-list li {
                border-bottom: 1px dashed var(--border);
                padding: 10px 0px;
                color: var(--font-color);
            }
            .hundred-list .completed {
                text-decoration: line-through;
                color: var(--light-font-color);
            }
            .hundred-list li a {
                color: var(--link-color);
                margin-left: 8px;
                text-decoration: none;
                transition: color 0.3s;
                position: relative;
                padding-right: 18px; /* 留出图标空间 */
            }
            .hundred-list li a:hover {
                color: var(--link-color-darker);
            }
            .hundred-list li a::after {
                content: '';
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 14px;
                height: 14px;
                /* 内嵌一个外链的 SVG 图标（浅灰色，带透明度以便适配） */
                background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="%235183f5" d="M10 6v2H5v11h11v-5h2v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h6zm11-3v9l-3.794-3.793-5.999 6-1.414-1.414 5.999-6L12 3h9z"/></svg>');
                background-size: cover;
                transition: opacity 0.3s;
                opacity: 0.8;
            }
            .hundred-list li a:hover::after {
                opacity: 1;
            }
            .hundred-list .completed a {
                text-decoration: none; /* 防止链接也被删除线划过 */
            }
            .hundred-list li svg {
                display: none; /* 隐藏掉原来代码中多余写的废弃 svg */
            }
            #progressbar {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .progressbar-container {
                width: 100%;
                background-color: var(--light-background);
                border-radius: 4px;
                overflow: hidden;
            }
            .proggress-bar-inner {
                height: 35px;
                width: 0%;
                background-color: var(--link-color);
                border-radius: 4px;
                transition: width 1s ease-in-out;
            }
            .percentCount {
                float: right;
                margin-top: 5px;
                font-weight: bold;
                color: var(--dark-font-color);
            }
            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }
        </style>

        <div class="article-post clearfix">
            <?php $this->content(); ?>
        </div>

        <?php if ($this->options->TheComments): ?>
        <div class="container" style="padding:0">
            <?php $this->need('comments.php'); ?>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>

<script>
$(function(){
    var quatityCompleted = $(".hundred-list .completed").length;
    var totalPercentage = quatityCompleted; // 默认是 100 件事
    
    // 如果总数不是100可以以此计算
    var total = $(".hundred-list li").length;
    if (total > 0 && total !== 100) {
        totalPercentage = Math.round((quatityCompleted / total) * 100);
    }
    
    // 动态生成不需要依赖的进度条
    var pbHtml = '<div class="progressbar-container">' +
                 '<div class="proggress-bar-inner" style="width: ' + totalPercentage + '%; background-color: #ef6c59;"></div>' +
                 '</div>' +
                 '<div class="percentCount">进度: ' + totalPercentage + '%</div>';
    
    var $pb = $('#progressbar');
    if($pb.length) {
        $pb.html(pbHtml);
    } else {
        // 如果页面没有自带 #progressbar 容器，自动在列表前面插入
        $('.hundred-list').before('<div id="progressbar">' + pbHtml + '</div>');
    }
});
</script>