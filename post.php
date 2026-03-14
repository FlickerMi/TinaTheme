<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php
// 灰色滤镜：检测文章标签中是否含有 gray
$tags = $this->tags;
if ($tags != null && strpos(json_encode($tags), 'gray')) {
?>
<style>
    html {
        -webkit-filter: grayscale(100%);
        filter: progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
    }
</style>
<?php } ?>

<?php
// JSON-LD 结构化数据（Article schema）
$jsonld = array(
    '@context'      => 'https://schema.org',
    '@type'         => 'Article',
    'headline'      => $this->title,
    'url'           => $this->permalink,
    'datePublished' => date('c', $this->created),
    'dateModified'  => date('c', $this->modified),
    'author'        => array(
        '@type' => 'Person',
        'name'  => $this->author->name,
    ),
    'publisher'     => array(
        '@type' => 'Organization',
        'name'  => $this->options->title,
    ),
);
?>
<script type="application/ld+json"><?php echo json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>

<main>
    <div class="container">
        <article>
            <header class="article-header">
                <div class="thumb">
                    <div>
                        <h1><?php $this->title() ?></h1>
                        <div class="post-meta">
                            <div>
                            <span>
                                By <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                            </span> |
                            <time datetime="<?php echo date('c', $this->created); ?>"><?php $this->date('M j, Y'); ?></time> |
                            <span>
                                <?php _e('Category: '); ?><?php $this->category(','); ?>
                            </span>
                            <?php if ($this->options->WordCount): ?>
                            <time> | 共 <?php echo word_count($this->cid); ?> 个字符</time>
                            <?php endif; ?>
                            <?php if (class_exists('Views_Plugin')): ?>
                            <time> | <?php Views_Plugin::theViews('', ' 次阅读'); ?></time>
                            <?php endif; ?>
                            </div>
                            <div class="tags">
                                <?php $this->tags(', ', true); ?>
                        </div>
                    </div>
                </div>
            </header>
        </article>
        <div id="post" class="article-post">
            <?php
            // 处理文章内容：[hide] 标签 + 图片 Fancybox 放大
            $rawContent = $this->content;

            // 先处理 [hide] 短代码（含数据库查询）
            $processedContent = getContentWithHide($rawContent, $this->cid, $this);

            // 图片点击放大（Fancybox）
            if ($this->options->fancybox) {
                $pattern = '/\<img((?:[^>](?!data-fancybox))*?)src\=\"(.*?)\"([^>]*)\>/i';
                $replacement = '<a href="$2" data-fancybox="gallery" data-caption=""><img$1src="$2"$3></a>';
                $processedContent = preg_replace($pattern, $replacement, $processedContent);
            }

            // --- 广告插入逻辑 (Ads Injection) ---
            
            // 1. 自定义位置广告：在文章编辑器中任意位置插入 [ads] 占位符，会被替换为自定义字段 ads 的内容
            if (isset($this->fields->ads) && !empty($this->fields->ads)) { 
                $adsHtml = '<div class="post-ads custom-position" style="margin: 20px 0;">' . $this->fields->ads . '</div>';
                // 替换所有的 [ads] 标签为广告逻辑
                $processedContent = str_replace('[ads]', $adsHtml, $processedContent);
            }

            // 2. 自动插入广告：自定义字段为 ads_h2，如果设置了，会在每个 h2 区块的末尾（即下一个 h2 之前，以及正文末尾）插入广告
            if (isset($this->fields->{'ads_h2'}) && !empty($this->fields->{'ads_h2'})) { 
                $adsH2Html = '<div class="post-ads h2-position" style="margin: 20px 0;">' . $this->fields->{'ads_h2'} . '</div>';
                
                $segments = preg_split('/(<h2[^>]*>)/i', $processedContent, -1, PREG_SPLIT_DELIM_CAPTURE);
                $segmentCount = count($segments);
                
                if ($segmentCount > 1) {
                    // 从第一个 h2 之后的内容块开始遍历，为每一个段落的末尾(下个h2之前)追加广告
                    for ($i = 2; $i < $segmentCount; $i += 2) {
                        $segments[$i] .= $adsH2Html;
                    }
                    $processedContent = implode('', $segments);
                } else {
                    // 备用方案：如果没有 h2 标签，则将广告放在正文末尾
                    $processedContent .= $adsH2Html;
                }
            }

            echo $processedContent;
            ?>
        </div>
    </div>


    <?php
    // 版权声明区块
    $permalink = $this->permalink;
    ?>
    <div class="container">
        <div class="copy-text">
            <div>
                <p>非特殊说明，本博所有文章均为博主原创。</p>
                <p>如若转载，请注明出处：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></p>
            </div>
        </div>
    </div>
    <?php if ($this->options->TheComments): ?>
    <div class="container">
        <?php $this->need('comments.php'); ?>
    </div>
    <?php endif; ?>

    <br><br>
    <div class="container">
        <nav class="flex container suggested">
            <?php prev_post($this);?>
            <?php next_post($this);?>
        </nav>
    </div>
</main>
<?php $this->need('footer.php'); ?>