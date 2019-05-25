<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:georss="http://www.georss.org/georss">
    <channel>
        {{                env('APP_STORAGE_DOMAIN')
        }}
        <title>{{ $settings['title'] }}</title>
        <link>{{ url('/') }}</link>
        <description>{{ $settings['description'] }}</description>
        <language>ru</language>

        @foreach ($items as $item)

            @php
                $item->title = str_replace("&", "&amp;", $item->title);
                $item->description = str_replace("&rdquo;", "”", $item->description);
                $item->description = str_replace("&ldquo;", "“", $item->description);

                $item->title = stripslashes($item->title);
                $item->description = stripslashes($item->description);
                $item->slug = stripslashes($item->slug);
                $item->id = stripslashes($item->id);

                if ($item->preview !='') {
                    $img = '<img src="' . env('APP_STORAGE_DOMAIN') . $item->preview . '" alt="' . $item->title . '" width="600">';
                } else {
                    $img = null;
                }
            @endphp

            <item>
                <title>{{ $item->title }}</title>
                <link>
                {{ url('/') }}/news/{{ $item->slug }}</link>
                <enclosure url="{{ env('APP_STORAGE_DOMAIN') . $item->preview }}" type="image/jpeg"/>
                <description><![CDATA[{!! $img !!} {!! $item->description !!}]]></description>
                <pubDate>{{ date('D, d M Y H:i:s', strtotime($item->created_at)) }} +0300</pubDate>
                <author>FITGUM</author>
                <content:encoded><![CDATA[ {!! $item->content !!}]]></content:encoded>
            </item>

        @endforeach

    </channel>
</rss>
