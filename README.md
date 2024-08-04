# Headless CMS
This repository features a headless CMS that is designed to be used with free/cheap PHP website hosting. The benefit to this CMS is that it allows for many users to upload articles, images, ZIP files, and more with secure authentication - all without the bloat that platforms like Wordpress tend to have.

This CMS is not intended to be seen by everyone, and should be hosted on a subdomain. You can then use static website hosting like Github Pages or Cloudflare Workers Pages to display the content that displays in /list.php.

You would use this CMS instead of writing your own blog engine in PHP if you have limited bandwidth on a free PHP host, for instance. Since most end-user page views would contain small amounts of JSON on your PHP host, this can minimize the bandwidth usage significantly, especially if you have CSS-heavy dependencies on your front-end.

## To install:
- Drag and drop the files in this repository onto your PHP host
- Ensure the SQL database has the following tables:

```sql
create table uploads
(
    id          int(20) unsigned auto_increment
        primary key,
    author      char(16)   not null,
    title       tinytext   not null,
    content     mediumtext null,
    upload_name tinytext   null,
    link_href   tinytext   null
);
create table users
(
    username char(16) not null
        primary key,
    password char(64) not null
);
```