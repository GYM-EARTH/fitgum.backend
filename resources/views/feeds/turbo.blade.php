<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<rss version="2.0"
     xmlns:yandex="http://news.yandex.ru"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:turbo="http://turbo.yandex.ru"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:georss="http://www.georss.org/georss">
    <channel>
        <title>{{ config('app.name') }}</title>
        <link>{{ url('/') }}</link>
        <description>Вы думаете каким спортом заняться? Наш сервис откроет для вас более сотни известных спортивных занятий и даст исчерпывающую информацию о каждом из них</description>
        <language>ru</language>

        @foreach ($clubs as $club)

            @php
                $title = str_replace("&", "&amp;", $club->title);
                $description = str_replace("&rdquo;", "”", $club->description);
                $description = str_replace("&ldquo;", "“", $club->description);

                $title = stripslashes($club->title);
                $description = stripslashes($club->description);
                $slug = stripslashes($club->slug);
                $id = stripslashes($club->id);

                if (!empty($club->cover)) {
                    $img = '<img src="'.config('url').$club->cover . '" alt="' . $club->title . '" width="600">';
                } else {
                    $img = null;
                }
            @endphp

            <item turbo="true">
                <title>{{ $title }}</title>
                <link>{{ url('/') }}clubs/{{$slug}}</link>
                <enclosure url="{{ env('APP_STORAGE_DOMAIN') . $club->cover}}" type="image/jpeg"/>
                <description><![CDATA[{!! $img !!} {!! $description !!}]]></description>
                <pubDate>{{ date('D, d M Y H:i:s', strtotime($club->created_at)) }} +0300</pubDate>
                <author>FITGUM</author>
                <content:encoded><![CDATA[ {!! $club->content !!}]]></content:encoded>
            </item>

        @endforeach

    </channel>
</rss>
