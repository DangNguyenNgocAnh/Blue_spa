<!DOCTYPE html>
<html>

<body>
    <header>
        {!! html_entity_decode(htmlspecialchars($data['header'])) !!}
    </header>
    <p>
        {!! html_entity_decode(htmlspecialchars($data['body'])) !!}
    </p>
    <footer>
        {!! html_entity_decode(htmlspecialchars($data['footer'])) !!}
    </footer>
</body>

</html>
