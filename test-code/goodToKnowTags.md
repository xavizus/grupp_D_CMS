
- __the_title()__ - tells WordPress to get the title of the page or post from the database and include it.
- __bloginfo( 'name' )__ - tells WordPress to get the blog title out of the database and include it in the template file. You can find more about valid values @ https://developer.wordpress.org/reference/functions/get_bloginfo/
- __have_posts()__ - Checks if there are any posts (returns true or false)
    - Wordpress got its own loop...
    ````php
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 
            // Display post content
            the_content();
        endwhile; 
    endif; 
    ````
__Loop tags__
- __next_post_link()__ – a link to the post published chronologically after the current post
- __previous_post_link()__ – a link to the post published chronologically before the current post
- __the_category()__ – the category or categories associated with the post or page being viewed
- __the_author()__ – the author of the post or page
- __the_content()__ – the main content for a post or page
- __the_excerpt()__ – the first 55 words of a post’s main content followed by an ellipsis (…) or read more link that goes to the full post. You may also use the “Excerpt” field of a post to customize the length of a particular excerpt.
- __the_ID()__ – the ID for the post or page
- __the_meta()__ – the custom fields associated with the post or page
- __the_shortlink()__ – a link to the page or post using the url of the site and the ID of the post or page
- __the_tags()__ – the tag or tags associated with the post
- __the_title()__ – the title of the post or page
- __the_time()__ – the time or date for the post or page. This can be customized using standard php date function formatting.

__Conditional tags for loops__
- __is_home()__ – Returns true if the current page is the homepage
- __is_admin()__ – Returns true if inside Administration Screen, false otherwise
- __is_single()__ – Returns true if the page is currently displaying a single post. Can also check for certain posts by ID and other parameters. The above example proves true when Post 17 is being displayed as a single Post.
- __is_page()__ – Returns true if the page is currently displaying a single page
is_page_template() – Can be used to determine if a page is using a specific template, for example: is_page_template('about-page.php')
- __is_category()__ – Returns true if page or post has the specified category, for example: is_category('news')
- __is_tag()__ – Returns true if a page or post has the specified tag
- __is_author()__ – Returns true if inside author’s archive page
- __is_search()__ – Returns true if the current page is a search results page
- __is_404()__ – Returns true if the current page does not exist
- __has_excerpt()__ – Returns true if the post or page has an excerpt

__Normal conditional tags__
- __is_user_logged_in()__ - checks if user is logged in or not.

__Post Type__
- __get_post_type()__ - You can test to see if the current post is of a certain type by including get_post_type() in your conditional.
- __post_type_exists()__ - Returns true if a given post type is a registered post type. 

__Tag Page__
- __is_tag('tagName')__ - When the archive page for tag with the slug of 'tagName' is being displayed.
- __has_tag()__ - When the current post has a tag. Must be used inside The Loop.

__Author page__
- __is_author()__ - When any Author page is being displayed.

__A Search Result Page__
- __is_search()__ - When a search result page archive is being displayed.