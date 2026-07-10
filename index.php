<?php
/**
 * 移植自<a href="https://limxw.com/" target="_blank">WingLim</a>的<a href="https://github.com/WingLim/hugo-tania" target="_blank">hugo-tania</a>主题，在其基础上进行了深度修改的 TinaTheme 或许是你在Typecho上最好的选择
 * <hr><div style="width:fit-content" id="TinaTheme">版本检测中...&nbsp;</div>
 * <script>var simversion="2.1.4";var buildversion = "50515";function update_detec(){var container=document.getElementById("TinaTheme");if(!container){return}var ajax=new XMLHttpRequest();container.style.display="block";ajax.open("get","https://tina.fmcf.cc/ThemeUpdate/tina_update.json");ajax.send();ajax.onreadystatechange=function(){if(ajax.readyState===4&&ajax.status===200){var obj=JSON.parse(ajax.responseText);var newest=obj.Build;if(newest>buildversion){container.innerHTML="发现新主题版本："+obj.name+'。下载地址：<a href="'+obj.zipball_url+'">点击下载</a>'+"<br>您目前的版本:"+String(simversion)+"。"+'<a target="_blank" href="'+obj.html_url+'">👉查看新版亮点</a>'}else{container.innerHTML="您目前的版本:"+String(simversion)+"。"+"您目前使用的是最新版。"}}}};update_detec();</script>
 * 
 * @package Tina Theme
 * @author Magneto
 * @version 2.1.4
 * @link https://www.fmcf.cc
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<main>
    <div class="container">
        <section class="my">
            <div class="author-identity">
                <?php
                $author_name = $this->options->IndexAuthorName ? $this->options->IndexAuthorName : $this->options->title;
                $avatar_url  = $this->options->IndexAvatar ? $this->options->IndexAvatar : $this->options->favicon;
                ?>
                <?php if ($avatar_url): ?>
                <img src="<?php echo htmlspecialchars($avatar_url); ?>" alt="<?php echo htmlspecialchars($author_name); ?>" class="author-avatar" width="64" height="64">
                <?php endif; ?>
                <div class="author-meta">
                    <h1 class="author-name"><?php echo htmlspecialchars($author_name); ?></h1>
                    <?php if ($this->options->description || $this->options->Notice): ?>
                    <div class="author-tagline">
                        <?php if ($this->options->Notice): ?>
                            <?php $this->options->Notice() ?>
                        <?php else: ?>
                            <p><?php $this->options->description() ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($this->options->Icons): ?>
            <div class="bio-social">
                <?php
                $icons_raw = $this->options->icons_data;
                if ($icons_raw) {
                    $icon_lines = preg_split('/\r\n|\r|\n/', trim($icons_raw));
                    foreach ($icon_lines as $icon_line) {
                        $icon_line = trim($icon_line);
                        if (empty($icon_line)) continue;
                        // 支持 SVG | URL | Label 三段格式，SVG 内部不含 " | "
                        $icon_parts = array_pad(array_map('trim', explode(' | ', $icon_line, 3)), 3, '');
                        $icon_svg = $icon_parts[0];
                        $icon_url = $icon_parts[1] ? $icon_parts[1] : '#';
                        $icon_label = $icon_parts[2];
                        if (empty($icon_url)) $icon_url = '#';
                        if (!empty($icon_label)) {
                            // 使用自定义标签
                        } elseif ($icon_url === '#') {
                            $icon_label = _t('社交链接');
                        } else {
                            $parsed = parse_url($icon_url);
                            if (!empty($parsed['host'])) {
                                $icon_label = $parsed['host'];
                                if (!empty($parsed['path']) && $parsed['path'] !== '/') {
                                    $icon_label .= rtrim($parsed['path'], '/');
                                }
                            }
                            if (empty($icon_label)) {
                                $icon_label = _t('社交链接');
                            }
                        }
                        if (stripos($icon_svg, 'aria-hidden') === false) {
                            $icon_svg = preg_replace('/<svg\b/i', '<svg aria-hidden="true"', $icon_svg, 1);
                        }
                        echo '<a href="' . htmlspecialchars($icon_url) . '" aria-label="' . htmlspecialchars($icon_label) . '" target="_blank" rel="noopener noreferrer">' . $icon_svg . '</a>' . "\n";
                    }
                }
                ?>
            </div>
            <?php endif; ?>

        </section>
    </div>
    <div class="container">
        <section>
            <h2><?php echo htmlspecialchars($this->options->IndexLatestTitle ? $this->options->IndexLatestTitle : _t('最新文章')); ?></h2>
            <div class="posts">
                <?php if ($this->have()): ?>
                <?php while($this->next()): ?>
                <div class="post">
                    <a href="<?php $this->permalink() ?>">
                    <div class="post-row">
                        <time datetime="<?php $this->date('c'); ?>"><?php $this->date('n月j日'); ?></time>
                        <h3><?php $this->title() ?></h3>
                    </div>
                    </a>
                </div>
             <?php endwhile; ?>
             <?php else: ?>
                <div class="empty-state"><p><?php _e('暂无文章，稍后再来。'); ?></p></div>
             <?php endif; ?>
            </div>
            <div class="view-more">
                <?php
                $archive_url = $this->options->IndexArchiveUrl ? $this->options->IndexArchiveUrl : '/articles.html';
                $archive_url = trim($archive_url);
                if (stripos($archive_url, 'http') !== 0) {
                    $archive_url = rtrim($this->options->siteUrl, '/') . '/' . ltrim($archive_url, '/');
                }
                ?>
                <a href="<?php echo htmlspecialchars($archive_url); ?>"><?php echo htmlspecialchars($this->options->IndexViewMore ? $this->options->IndexViewMore : _t('查看更多')); ?> &raquo;</a>
            </div>
        </section>
        <?php if ($this->options->Projects): ?>
        <section>
            <h2><?php echo htmlspecialchars($this->options->IndexProjectsTitle ? $this->options->IndexProjectsTitle : _t('项目')); ?></h2>
            <div class="projects">
            <?php
            $projects_raw = $this->options->projects_data;
            if ($projects_raw) {
                $project_lines = preg_split('/\r\n|\r|\n/', trim($projects_raw));
                foreach ($project_lines as $project_line) {
                    $project_line = trim($project_line);
                    if (empty($project_line)) continue;
                    $parts = array_pad(array_map('trim', explode('|', $project_line, 4)), 4, '');
                    list($p_name, $p_url, $p_icon, $p_desc) = $parts;
                    if (empty($p_url)) $p_url = '#';
                    ?>
                <div class="project">
                    <div>
                        <div class="project-title">
                        <?php if ($p_icon): ?>
                            <div class="icon"><img src="<?php echo htmlspecialchars($p_icon); ?>" height="30" width="30" alt=""></div>
                        <?php endif; ?>
                        <h3><?php echo $p_name ? htmlspecialchars($p_name) : _t('未命名项目'); ?></h3>
                        </div>
                    <?php if ($p_desc): ?>
                        <div class="description"><?php echo htmlspecialchars($p_desc); ?></div>
                    <?php endif; ?>
                    </div>
                    <div class="flex">
                        <a href="<?php echo htmlspecialchars($p_url); ?>" class="button" target="_blank" rel="noreferrer"><?php echo htmlspecialchars($this->options->ProjectButtonText ? $this->options->ProjectButtonText : _t('访问')); ?></a>
                    </div>
                </div>
                    <?php
                }
            }
            ?>
            </div>
        </section>
        <?php endif; ?>

    </div>
</main>
<?php $this->need('footer.php'); ?>
