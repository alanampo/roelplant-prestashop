{foreach from=$reviews item=review}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Review",
        "reviewBody": "{$review.description|escape:'html':'UTF-8'}",
        "author": {
            "@type": "Person",
            "name": {if $review.author}"{$review.author}"{else}"{$shop.name}"{/if}
        },
        "datePublished": "{$review.public_date|strtotime|date_format:"%Y-%m-%d"}",
        "itemReviewed": {
            "@type": "Product",
            "name": "{$productObject->name}",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{$rating.averageRating|round:1|escape:'html':'UTF-8'}",
                "reviewCount": "{$rating.nbComments|escape:'html':'UTF-8'}"
            }
        },
        "reviewRating": {
            "@type": "Rating",
            "ratingValue": {$review.rate|round:1},
            "worstRating": 1,
            "bestRating": 5
        }
    }
    </script>
{/foreach}