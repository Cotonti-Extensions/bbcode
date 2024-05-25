# BBCode

BBcode Parser plugin for [CMF Cotonti](https://www.cotonti.com). Customizable support for BBCodes and smilies parsing. 
Adds BBCode parser support to the contents.

Authors: Cotonti Team

Plugin page: https://www.cotonti.com/extensions/administration-management/menu-generator

**BBCode** ("Bulletin Board Code") is a lightweight markup language used to format messages in many
Internet forum software. It was first introduced in 1998. The available "tags" of BBCode are 
usually indicated by square brackets (**[** and **]**) surrounding a keyword, and are parsed 
before being translated into HTML

## Installation
- Unpack to your plugins folder
- Install the plugin in Administration panel
- Set default markup parser in site settings: https://domaint.tld/admin.php?m=config&n=edit&o=core&p=main
Or for pages module: https://domaint.tld/admin.php?m=config&n=edit&o=module&p=page
- Optionally install the [markItUp!](https://github.com/Cotonti-Extensions/markitup) editor with bbcode support

## BBCodes examples
| BBCode | Example in HTML/CSS | Output |
|-|-|-|
|[b]bolded text[/b]|`<strong>bolded text</strong>`|**bolded text**|
|[i]italicized text[/i]|`<em>italicized text</em>`|_italicized text_|
|[u]underlined text[/u]|`<span style="text-decoration: underline;">underlined text</span>`| |
|[s]strikethrough text[/s]|`<span style="text-decoration: line-through;">strikethrough text</span>`| ~~ strikethrough text ~~ |

more bbcodes you will find in the plugin admin panel https://domaint.tld/admin.php?m=other&p=bbcode
