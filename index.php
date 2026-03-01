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
            <div class="content">
                <p>
                    <?php if ($this->options->Notice): ?>
                        <?php $this->options->Notice() ?>
                    <?php else: ?>
                        <?php $this->options->description() ?>
                    <?php endif; ?>
                </p>
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
                        // 只在第一个 | 处分割（SVG 内部可能不含 |，但保险起见限制只分一次）
                        $sep_pos = strpos($icon_line, ' | ');
                        if ($sep_pos !== false) {
                            $icon_svg = trim(substr($icon_line, 0, $sep_pos));
                            $icon_url = trim(substr($icon_line, $sep_pos + 3));
                        } else {
                            $icon_svg = $icon_line;
                            $icon_url = '#';
                        }
                        if (empty($icon_url)) $icon_url = '#';
                        echo '<a href="' . htmlspecialchars($icon_url) . '" target="_blank">' . $icon_svg . '</a>' . "\n";
                    }
                }
                ?>
            </div>
            <?php endif; ?>

        </section>
    </div>
    <div class="container">
        <section>
            <h2>Latest Articles</h2>
            <div class="post">
                <?php while($this->next()): ?>
                <div class="post">
                    <a href="<?php $this->permalink() ?>">
                    <div class="post-row">
                        <time><?php $this->date('M j'); ?></time>
                        <h3><?php $this->title() ?></h3>
                    </div>
                    </a>
                </div>
             <?php endwhile; ?>
            </div>
            <div style="margin-top: 1rem; text-align: right;">
                <a href="/articles.html">View More &raquo;</a>
            </div>
        </section>
        <?php if ($this->options->Projects): ?>
        <section>
            <h2>Projects</h2>
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
                        <a href="<?php echo htmlspecialchars($p_url); ?>" target="_blank" rel="noreferrer">
                        <?php if ($p_icon): ?>
                            <div class="icon"><img src="<?php echo htmlspecialchars($p_icon); ?>" height="30px" width="30px"></div>
                        <?php else: ?>
                            <div class="icon"></div>
                        <?php endif; ?>
                        <h3><?php echo $p_name ? htmlspecialchars($p_name) : 'Project'; ?></h3>
                        </a>
                    <?php if ($p_desc): ?>
                        <div class="description"><?php echo htmlspecialchars($p_desc); ?></div>
                    <?php else: ?>
                        <div class="description"></div>
                    <?php endif; ?>
                    </div>
                    <div class="flex">
                        <a href="<?php echo htmlspecialchars($p_url); ?>" class="button" target="_blank" rel="noreferrer">Source</a>
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
