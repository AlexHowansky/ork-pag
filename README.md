# Pick-a-Game

**Pick-a-Game** a.k.a. **PAG** attempts to help answer the age-old question,
"What should we play?" It is a simple web app to catalog, browse, and search
your board game collection. It pulls data from the
[Board Game Geek](http://boardgamegeek.com) API and caches it to a local SQLite
database for quick searches.

## Installation

You'll need a PHP runtime. For a production deployment, you'll also need a web
server. Install with:

```sh
git clone https://github.com/AlexHowansky/ork-pag.git
composer install --no-dev
```

For a temporary local server, run `composer go`.

For a more permanent installation, create a vhost on your webserver and point
its document root at the `public` directory of this checkout.

## Local Data Cache

Run `bin/sync <BGG username>` to pull/sync your collection from BGG. The
username is case sensitive. Any game that you have marked as "Own" on BGG
will be copied into the local database for the indicated user. Optional
parameters include:

`--all`

Update game details for all games owned by this user. As this requires an API
hit per game, and BGG has a fairly restrictive usage throttle, this may take
some time. By default, details are updated only for newly created game records.

`--pattern <pattern>`

A slash-delimited regular expression or a case insensitive substring to match
the name on. Only matching titles will be synced.

## Labels

![example label](label.png "example label")

<strong>PAG</strong> can create box labels to summarize important game
characteristics in a consistent place and format. These are designed to fit on
standard Avery 5160 address label sheets, and include a QR code to the BGG
detail page for that game. When printing, make sure to disable any fit-to-page
feature that your system offers. Print the document at actual size or 100% zoom.
To generate a PDF of labels, run `bin/labels <BGG username>`. Optional
parameters include:

`--pattern <pattern>`

A slash-delimited regular expression or a case insensitive substring to match
the name on. Only matching titles will be included.

`--limit <limit>`

Limit the number of labels to this value, with 30 fitting on one page.

`--limit <skip>`

The number of label spaces to skip. This is useful if you've got a label sheet
with some labels already used. These are counted starting from the upper left,
going left to right then top to bottom. So, a `<skip>` value of 4 will result
in the first label being located in the middle column of the second row.
