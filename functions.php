<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define('INITIAL_VERSION_NUMBER', '1.0');
if (Helper::options()->GravatarUrl) define('__TYPECHO_GRAVATAR_PREFIX__', Helper::options()->GravatarUrl);
require_once __DIR__ . '/core/functions.php';

function themeConfig($form) {
    require_once __DIR__ . '/core/backup.php';
    /* 外观 */
    $NoticeAppearance = new Typecho_Widget_Helper_Form_Element_Text('NoticeAppearance', NULL, NULL, _t('<h2>基础外观</h2>'));
    $NoticeAppearance->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeAppearance);
    
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, '/usr/themes/TinaTheme/assets/favicon.ico', _t('Favicon 图标'), _t('在这里填入一个图片 URL 地址, 以添加一个 Favicon，留空则不单独设置 Favicon，主题默认 Favicon 地址为 /usr/themes/TinaTheme/assets/favicon.ico'));
	$form->addInput($favicon);
	
	$nav_links = new Typecho_Widget_Helper_Form_Element_Textarea('nav_links', NULL, 'Articles | /index.php/articles.html', _t('顶部导航链接'), _t('顶部导航栏的链接，每行一个，格式：<code>显示名称 | 链接URL</code>。留空则不显示该行对应的链接。示例：<br><code>Articles | /index.php/articles.html</code><br><code>友链 | /index.php/links.html</code>'));
    $form->addInput($nav_links);

	$cursor = new Typecho_Widget_Helper_Form_Element_Radio(
        'cursor',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        0,
        _t('鼠标美化'),
        _t('开启后电脑端网页会对鼠标进行美化，手机端不会美化，默认关闭。')
    );
    $form->addInput($cursor);
    
     /* Notice */
    $NoticeContent = new Typecho_Widget_Helper_Form_Element_Text('NoticeContent', NULL, NULL, _t('<h2>内容设置 <small>Contents</small></h2>'));
    $NoticeContent->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeContent);
    
    $Notice = new Typecho_Widget_Helper_Form_Element_Textarea('Notice', NULL, NULL, _t('网站首页公告'), _t('支持HTML语法，但不建议使用HTML语法。不填则代表为默认内容。'));
    $form->addInput($Notice);
    
    $FooterHTML = new Typecho_Widget_Helper_Form_Element_Textarea('FooterHTML', NULL, NULL, _t('自定义页脚内容'), _t('支持HTML语法。不填则代表为空。'));
    $form->addInput($FooterHTML);
    
    /* 速度优化 */
    $NoticeSpeed = new Typecho_Widget_Helper_Form_Element_Text('NoticeSpeed', NULL, NULL, _t('<h2>速度优化</h2>'));
    $NoticeSpeed->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeSpeed);
    
    $compressHtml = new Typecho_Widget_Helper_Form_Element_Radio(
        'compressHtml',
        array(
            1 => _t('启用'),
            0 => _t('关闭')
        ),
        0,
        _t('HTML压缩'),
        _t('默认关闭，启用则会对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情选择开启或者关闭')
    );
    $form->addInput($compressHtml);
    
    $GravatarUrl = new Typecho_Widget_Helper_Form_Element_Radio('GravatarUrl', 
    array
    (
        false => _t('官方源'),
        'https://cdn.helingqi.com/avatar/' => _t('禾令奇源'),
        'https://sdn.geekzu.org/avatar/' => _t('极客族源'),
        'https://dn-qiniu-avatar.qbox.me/avatar/' => _t('七牛源')
	),
	'https://cdn.helingqi.com/avatar/', _t('Gravatar头像源'), _t('默认禾令奇源'));
	$form->addInput($GravatarUrl);
    
    $cjCDN = new Typecho_Widget_Helper_Form_Element_Radio(
        'cjCDN',
        array(
            'bc' => _t('BootCDN'),
            'cf' => _t('CDNJS'),
            'jd' => _t('jsDelivr'),
            'custom' => _t('自建')
        ),
        'bc',
        _t('公共静态资源来源'),
        _t('默认BootCDN，请根据需求选择合适来源')
    );
    $form->addInput($cjCDN);

    $cjCDNlink = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cjCDNlink',
        null,
        null,
        _t('公共静态资源自建地址'),
        _t('只在上面的选项选择自建时需要，<a href="https://tina.docs.fmcf.cc/optimization/public_cdn/" target="_blank">[查看建规则]</a>')
    );
    $form->addInput($cjCDNlink);
    
    /* 网站功能 */
    $NoticeFeature = new Typecho_Widget_Helper_Form_Element_Text('NoticeFeature', NULL, NULL, _t('<h2>网站功能</h2>'));
    $NoticeFeature->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeFeature);
    
    $JqueryControl = new Typecho_Widget_Helper_Form_Element_Radio(
        'JqueryControl',
        array(
            1 => _t('启用'),
            0 => _t('关闭')
        ),
        1,
        _t('JqueryControl'),
        _t('默认开启，<font color="#ed5a65">如果要使用PJAX、Fancybox、Lazyload必须开启 Jquery 控件！</font>')
    );
    $form->addInput($JqueryControl);

    $fancybox = new Typecho_Widget_Helper_Form_Element_Radio(
        'fancybox',
        array(
            1 => _t('启用'),
            0 => _t('关闭')
        ),
        1,
        _t('图片灯箱及Lazyload'),
        _t('默认开启，启用后可以优化图片浏览的体验')
    );
    $form->addInput($fancybox);
    
    $SEOOPEN = new Typecho_Widget_Helper_Form_Element_Radio(
        'SEOOPEN',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('SEO系统'),
        _t('关闭后网站SEO将会关闭(本SEO系统，采用Typecho原生SEO，默认开启)<br><strong>网站关键词、网站描述均调用自系统，修改请前往路径“后台->基本设置->网站关键词 或 网站描述”</strong>')
    );
    $form->addInput($SEOOPEN);
    
    $WordCount = new Typecho_Widget_Helper_Form_Element_Radio(
        'WordCount',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('字数统计'),
        _t('在网站的文章页面及自建页面中显示内容总字数')
    );
    $form->addInput($WordCount);
    
    $WebPjax = new Typecho_Widget_Helper_Form_Element_Radio(
        'WebPjax',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('PJAX'),
        _t('全站PJAX无刷新加载，评论区暂不支持PJAX')
    );
    $form->addInput($WebPjax);

    $MathRender = new Typecho_Widget_Helper_Form_Element_Radio(
        'MathRender',
        array(
            'MathJax' => _t('MathJax'),
            'KaTeX' => _t('KaTeX'),
            'Close' => _t('关闭')
        ),
        'KaTeX',
        _t('数学公式渲染'),
        _t('用于对数学公式的渲染')
    );
    $form->addInput($MathRender);
    
    /* 评论 */
    $NoticeComment = new Typecho_Widget_Helper_Form_Element_Text('NoticeComment', NULL, NULL, _t('<h2>评论 <small>Comments</small></h2>'));
    $NoticeComment->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeComment);
    
    $TheComments = new Typecho_Widget_Helper_Form_Element_Radio(
        'TheComments',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('全局评论'),
        _t('关闭后全部文章不提供评论区。')
    );
    $form->addInput($TheComments);
    
    $TheVerification = new Typecho_Widget_Helper_Form_Element_Radio(
        'TheVerification',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('评论验证'),
        _t('评论区的加减法验证系统，关闭后反垃圾评论效果降低。')
    );
    $form->addInput($TheVerification);
    
    /* 深色模式 */
    $NoticeDarkMode = new Typecho_Widget_Helper_Form_Element_Text('NoticeDarkMode', NULL, NULL, _t('<h2>深色模式 <small>Dark Mode</small></h2>'));
    $NoticeDarkMode->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeDarkMode);
    
    $The_Dark_Mode = new Typecho_Widget_Helper_Form_Element_Radio(
        'The_Dark_Mode',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        1,
        _t('深色模式'),
        _t('如果你不喜欢深色模式，或者认为深色模式有瑕疵你可以选择关闭深色模式的开关。<br>关闭此开关后，性能将会得到一定程度的提升。')
    );
    $form->addInput($The_Dark_Mode);
    
	/* 图标 */
    $NoticeIcon = new Typecho_Widget_Helper_Form_Element_Text('NoticeIcon', NULL, NULL, _t('<h2>图标 <small>Icon</small></h2>'));
    $NoticeIcon->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeIcon);
    
    $Icons = new Typecho_Widget_Helper_Form_Element_Radio(
        'Icons',
        array(
            1 => _t('开启'),
            0 => _t('关闭')
        ),
        0,
        _t('首页图标'),
        _t('开启后可在首页公告下方见到图标，这些图标可以指向你的社交账号、Github等地址。<strong><font color="#ed5a65">注意:倘若关闭，则所有图标将不会显示</font></strong>')
    );
    $form->addInput($Icons);

	$icons_data = new Typecho_Widget_Helper_Form_Element_Textarea('icons_data', NULL, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-github-icon lucide-github"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg> | https://github.com/FlickerMi', _t('图标列表'), _t('每行一个图标，格式：<code>SVG代码 | 链接URL</code>。SVG 推荐大小 25x25，链接留空可填 <code>#</code>。示例：<br><code>&lt;svg ...&gt;...&lt;/svg&gt; | https://github.com/xxx</code><br><code>&lt;svg ...&gt;...&lt;/svg&gt; | https://twitter.com/xxx</code>'));
	$form->addInput($icons_data);

	/* 项目推荐 */
    $NoticeProject = new Typecho_Widget_Helper_Form_Element_Text('NoticeProject', NULL, NULL, _t('<h2>项目推荐 <small>Projects</small></h2>'));
    $NoticeProject->input->setAttribute('style', 'display:none');
    $form->addInput($NoticeProject);
    
	$Projects = new Typecho_Widget_Helper_Form_Element_Radio(
        'Projects',
        array(
            true => _t('开启'),
            false => _t('关闭')
        ),
        false,
        _t('项目推荐'),
        _t('开启后可在首页见到项目推荐，<strong><font color="#ed5a65">注意:倘若关闭，则所有有关项目的内容将不会生效</font></strong>')
    );
    $form->addInput($Projects);

	$projects_data = new Typecho_Widget_Helper_Form_Element_Textarea('projects_data', NULL, 'TinaTheme | https://www.github.com/ouyangyanhuo/TinaTheme | /usr/themes/TinaTheme/assets/favicon.ico | A theme for Typecho', _t('项目列表'), _t('每行一个项目，格式：<code>名称 | 链接URL | 图标URL | 描述</code>。图标URL 和描述可留空。示例：<br><code>TinaTheme | https://github.com/xxx/TinaTheme | /usr/themes/TinaTheme/assets/favicon.ico | A theme for Typecho</code><br><code>MyProject | https://github.com/xxx/MyProject | | My awesome project</code>'));
	$form->addInput($projects_data);

}