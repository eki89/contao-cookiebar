- [Install](INSTALL.md)
- [**Configuration (Basics)**](BASICS.md)
    - [Create Configuration](CONFIGURATION.md)
    - [Create Group](GROUP.md)
    - [Create Cookie (Type)](COOKIE.md)
- [Module & Content-Element](MOD_CE.md)
- [Styling & Customization](CUSTOMIZATION.md)
- [Extend iFrame-Types](EXTEND_IFRAME.md)
- [Extend Cookie-Types](EXTEND_TYPE.md)
- [Extended usage](EXTENDED_USAGE.md)

---

# Basic configuration
Basic settings must be maintained via the `config/config.yml` file. 

ℹ The following values are set by default, they do not need to be added to the YML file again.

```yaml
contao_cookiebar:
  consider_dnt: false
  anonymize_ip: true
  storage_key: ccb_contao_token
  page_templates:
    - fe_page
  iframe_types:
    youtube: 
      - ce_youtube
    vimeo: 
      - ce_vimeo
    googlemaps:
      - ce_html_googlemaps
      - mod_html_googlemaps
```

Parameter | Description
---------- | -----------
`consider_dnt` | Consider "Do not Track" browser setting
`anonymize_ip` | Anonymizes the visitor's IP address for each log entry using [Symfony IP Address Anonymizer](https://symfony.com/blog/new-in-symfony-4-4-ip-address-anonymizer).
`storage_key` | The key used for localStorage
`page_templates` | An array with page templates which should be considered. Since version `1.8.2` all templates which start with `fe_page_` are considered by default.
`iframe_types.*` | An array of iFrame-Types and the corresponding templates. By customizing this array, any type can be added (see [Create own iFrame-Types](EXTEND_IFRAME.md))

# Console Commands
The anonymization of all entries can be triggered via the console as follows:
```
vendor/bin/contao-console cookiebar:anonymizeip
```
