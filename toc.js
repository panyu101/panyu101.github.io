// Populate the sidebar
//
// This is a script, and not included directly in the page, to control the total size of the book.
// The TOC contains an entry for each page, so if each page includes a copy of the TOC,
// the total size of the page becomes O(n**2).
class MDBookSidebarScrollbox extends HTMLElement {
    constructor() {
        super();
    }
    connectedCallback() {
        this.innerHTML = '<ol class="chapter"><li class="chapter-item expanded affix "><a href="index.html">Summary</a></li><li class="chapter-item expanded "><a href="cli_samples/index.html"><strong aria-hidden="true">1.</strong> CLI Samples</a></li><li><ol class="section"><li class="chapter-item expanded "><a href="cli_samples/linux.html"><strong aria-hidden="true">1.1.</strong> Linux</a></li><li class="chapter-item expanded "><a href="cli_samples/ubuntu.html"><strong aria-hidden="true">1.2.</strong> Ubuntu</a></li><li class="chapter-item expanded "><a href="cli_samples/alpine.html"><strong aria-hidden="true">1.3.</strong> Alpine</a></li><li class="chapter-item expanded "><a href="cli_samples/windows.html"><strong aria-hidden="true">1.4.</strong> Windows</a></li><li class="chapter-item expanded "><a href="cli_samples/bash.html"><strong aria-hidden="true">1.5.</strong> Bash</a></li><li class="chapter-item expanded "><a href="cli_samples/aws.html"><strong aria-hidden="true">1.6.</strong> AWS</a></li><li class="chapter-item expanded "><a href="cli_samples/mysql.html"><strong aria-hidden="true">1.7.</strong> MySQL</a></li><li class="chapter-item expanded "><a href="cli_samples/docker.html"><strong aria-hidden="true">1.8.</strong> Docker</a></li><li class="chapter-item expanded "><a href="cli_samples/apache.html"><strong aria-hidden="true">1.9.</strong> Apache</a></li><li class="chapter-item expanded "><a href="cli_samples/nginx.html"><strong aria-hidden="true">1.10.</strong> Nginx</a></li><li class="chapter-item expanded "><a href="cli_samples/php.html"><strong aria-hidden="true">1.11.</strong> PHP</a></li><li class="chapter-item expanded "><a href="cli_samples/git.html"><strong aria-hidden="true">1.12.</strong> Git</a></li><li class="chapter-item expanded "><a href="cli_samples/utility.html"><strong aria-hidden="true">1.13.</strong> Utility</a></li></ol></li><li class="chapter-item expanded "><a href="pages/index.html"><strong aria-hidden="true">2.</strong> Pages</a></li><li><ol class="section"><li class="chapter-item expanded "><a href="pages/clock/index.html"><strong aria-hidden="true">2.1.</strong> Clock</a></li><li class="chapter-item expanded "><a href="pages/clock-fancy/index.html"><strong aria-hidden="true">2.2.</strong> Clock Fancy</a></li><li class="chapter-item expanded "><a href="pages/crontab/crontab.html"><strong aria-hidden="true">2.3.</strong> Crontab</a></li><li class="chapter-item expanded "><a href="pages/world-time-zone/world-time-zone.html"><strong aria-hidden="true">2.4.</strong> World Time Zone</a></li><li class="chapter-item expanded "><a href="pages/legoJ/index.html"><strong aria-hidden="true">2.5.</strong> Lego J</a></li><li class="chapter-item expanded "><a href="pages/legoX/index.html"><strong aria-hidden="true">2.6.</strong> Lego X</a></li><li class="chapter-item expanded "><a href="pages/XJ/index.html"><strong aria-hidden="true">2.7.</strong> Progress XJ</a></li></ol></li><li class="chapter-item expanded "><a href="collections/index.html"><strong aria-hidden="true">3.</strong> Collections</a></li><li><ol class="section"><li class="chapter-item expanded "><a href="collections/cli.html"><strong aria-hidden="true">3.1.</strong> Cli Tools</a></li><li class="chapter-item expanded "><a href="collections/sass.html"><strong aria-hidden="true">3.2.</strong> SASS Tools</a></li><li class="chapter-item expanded "><a href="collections/websites.html"><strong aria-hidden="true">3.3.</strong> Utility Websites</a></li></ol></li><li class="chapter-item expanded "><a href="languages/index.html"><strong aria-hidden="true">4.</strong> Languages</a></li><li><ol class="section"><li class="chapter-item expanded "><a href="languages/shell.html"><strong aria-hidden="true">4.1.</strong> Shell</a></li><li class="chapter-item expanded "><a href="languages/rust.html"><strong aria-hidden="true">4.2.</strong> Rust</a></li><li class="chapter-item expanded "><a href="languages/markdown.html"><strong aria-hidden="true">4.3.</strong> Markdown</a></li><li class="chapter-item expanded "><a href="languages/nodejs.html"><strong aria-hidden="true">4.4.</strong> Nodejs</a></li></ol></li><li class="chapter-item expanded "><a href="tools/index.html"><strong aria-hidden="true">5.</strong> Tools</a></li><li><ol class="section"><li class="chapter-item expanded "><a href="tools/docker.html"><strong aria-hidden="true">5.1.</strong> Docker</a></li><li class="chapter-item expanded "><a href="tools/git.html"><strong aria-hidden="true">5.2.</strong> Git</a></li><li class="chapter-item expanded "><a href="tools/github-ci.html"><strong aria-hidden="true">5.3.</strong> Github CI</a></li><li class="chapter-item expanded "><a href="tools/linux.html"><strong aria-hidden="true">5.4.</strong> Linux</a></li><li class="chapter-item expanded "><a href="tools/redis.html"><strong aria-hidden="true">5.5.</strong> Redis</a></li></ol></li></ol>';
        // Set the current, active page, and reveal it if it's hidden
        let current_page = document.location.href.toString().split("#")[0];
        if (current_page.endsWith("/")) {
            current_page += "index.html";
        }
        var links = Array.prototype.slice.call(this.querySelectorAll("a"));
        var l = links.length;
        for (var i = 0; i < l; ++i) {
            var link = links[i];
            var href = link.getAttribute("href");
            if (href && !href.startsWith("#") && !/^(?:[a-z+]+:)?\/\//.test(href)) {
                link.href = path_to_root + href;
            }
            // The "index" page is supposed to alias the first chapter in the book.
            if (link.href === current_page || (i === 0 && path_to_root === "" && current_page.endsWith("/index.html"))) {
                link.classList.add("active");
                var parent = link.parentElement;
                if (parent && parent.classList.contains("chapter-item")) {
                    parent.classList.add("expanded");
                }
                while (parent) {
                    if (parent.tagName === "LI" && parent.previousElementSibling) {
                        if (parent.previousElementSibling.classList.contains("chapter-item")) {
                            parent.previousElementSibling.classList.add("expanded");
                        }
                    }
                    parent = parent.parentElement;
                }
            }
        }
        // Track and set sidebar scroll position
        this.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                sessionStorage.setItem('sidebar-scroll', this.scrollTop);
            }
        }, { passive: true });
        var sidebarScrollTop = sessionStorage.getItem('sidebar-scroll');
        sessionStorage.removeItem('sidebar-scroll');
        if (sidebarScrollTop) {
            // preserve sidebar scroll position when navigating via links within sidebar
            this.scrollTop = sidebarScrollTop;
        } else {
            // scroll sidebar to current active section when navigating via "next/previous chapter" buttons
            var activeSection = document.querySelector('#sidebar .active');
            if (activeSection) {
                activeSection.scrollIntoView({ block: 'center' });
            }
        }
        // Toggle buttons
        var sidebarAnchorToggles = document.querySelectorAll('#sidebar a.toggle');
        function toggleSection(ev) {
            ev.currentTarget.parentElement.classList.toggle('expanded');
        }
        Array.from(sidebarAnchorToggles).forEach(function (el) {
            el.addEventListener('click', toggleSection);
        });
    }
}
window.customElements.define("mdbook-sidebar-scrollbox", MDBookSidebarScrollbox);
