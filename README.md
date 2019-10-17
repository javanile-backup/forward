# forwarding

```bash
curl -H "to=admin@admin.dev" \
     -H "token=23d23esqdsqwd1esdasdasd" \
     -H "subject=My first report" \
     -F "report=@report.txt" \
     -L "https://forwarding.myserver.dev"
```

http://forward.javanile.org/forward.javanile.org/template.php?report=tests/fixtures/report.txt