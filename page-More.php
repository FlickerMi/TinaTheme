<?php 
/**
 * 更多
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<main>
    <header>
        <div class="container">
            <h1><?php $this->title() ?></h1>
            <p class="subtitle">探索更多内容</p>
        </div>
    </header>
    <div class="container">
        <style>
            .more-r {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
                gap: 1.5rem;
                margin: 2rem 0;
            }
            .more-r a {
                text-decoration: none;
                display: block;
                height: 100%;
                box-shadow: none;
            }
            .more-r a:hover {
                box-shadow: none;
            }
            .case-item {
                background: var(--light-background);
                border-radius: 8px;
                padding: 1.5rem 1rem;
                text-align: center;
                transition: all 0.3s ease;
                color: var(--font-color);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                font-size: 1rem;
                height: 100%;
                font-weight: 500;
            }
            .case-item:hover {
                background: var(--light-background-hover);
                transform: translateY(-5px);
                color: var(--link-color);
                box-shadow: 0 4px 15px var(--transparent-bg);
            }
            .case-item__icon {
                width: 36px;
                height: 36px;
                margin-bottom: 0.8rem;
                fill: currentColor;
                object-fit: contain;
                display: block;
            }
        </style>

        <div class="article-post">
            <div class="more-r">
                <a href="/for-love.html">
                    <div class="case-item mdui-ripple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                        <span>ForLove</span>
                    </div>
                </a>
                
                <a href="/100-things-of-love.html">
                    <div class="case-item mdui-ripple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-laugh-icon lucide-laugh"><circle cx="12" cy="12" r="10"/><path d="M18 13a6 6 0 0 1-6 5 6 6 0 0 1-6-5h12Z"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>
                        <span>One hundred</span>
                    </div>
                </a>
                
                <a href="/links.html">
                    <div class="case-item mdui-ripple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round-icon lucide-square-user-round"><path d="M18 21a6 6 0 0 0-12 0"/><circle cx="12" cy="11" r="4"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                        <span>友链</span>
                    </div>
                </a>

                <a href="/about.html">
                    <div class="case-item mdui-ripple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-user-round-icon lucide-square-user-round"><path d="M18 21a6 6 0 0 0-12 0"/><circle cx="12" cy="11" r="4"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                        <span>关于</span>
                    </div>
                </a>
            </div>

        </div>
        
        <?php if ($this->options->TheComments): ?>
        <div class="container" style="padding:0">
            <?php $this->need('comments.php'); ?>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php $this->need('footer.php'); ?>
