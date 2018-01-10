# URL Shortener

Your goal is to implement simple URL shortener API (similar to `goo.gl`, `bit.ly`...)

For a given [URL][8fbe7571], your web app should produce a shortened version of it 
based on some criteria you can decide. Once the user visits your shortened URL, 
they should be redirected to original URL.

## Specification

### Shortening URLs

Your application should accept HTTP `POST` requests to `/shorten` endpoint, 
and request should carry a body similar to this one:

```json
{"url": "https://www.google.com"}
```

Application should respond with `200 OK` and a JSON body containing a shortened URL:

```json
{"original_link":"https://www.google.com","short_link":"http://localhost/95UdHJTj"}
```

Once user visits the shortened URL (e.g. <http://localhost/95UdHJTj>), 
they should be redirected to original URL using [301 Moved Permanently][718dcc3a].

In case shortened URL does not exist, you should return `404`

### Examples

`POST` to `/shorten` to create a shortened URL:

```bash
$ curl -X POST -H 'Content-Type: application/json' -d '{"url": "https://www.google.com"}' http://localhost/shorten
```

It should respond with body like

```json
{"original_link":"https://www.google.com","short_link":"http://localhost/95UdHJTj"}
```

Then, when issuing a `GET` request to a shortened URL:

```bash
$ curl http://localhost/95UdHJTj -v
```

The response should be `301 Moved Permanently`

```bash
< HTTP/1.1 301 Moved Permanently
< Content-Length: 0
< Location: https://www.google.com
```

## Solution

You should provide source code for your solution (preferably on GitHub)
with instructions how to run it.

## Notes

- If you're stuck, or need additional info - let us know.
- You can implement your solution in any language you see fit.


[718dcc3a]: https://httpstatuses.com/301 "301 Moved Permanently"
[8fbe7571]: https://en.wikipedia.org/wiki/URL "URL"
