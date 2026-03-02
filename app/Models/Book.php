<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;


class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "auteur"
    ];
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title){
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopePopular(Builder $query, $from = null, $to = null):Builder | QueryBuilder{
        return $query
        ->withCount([
            "reviews" => function (Builder $q) use ($from, $to) {
                $this->dateRangeFilter($q, $from, $to);
            }
        ])
        ->orderBy("reviews_count", "desc");
    }

    public function scopehighestRated(Builder $query, $from = null, $to = null):Builder | QueryBuilder{
        return $query
        ->withAvg([
            "reviews" => function (Builder $q) use ($from, $to) {
                $this->dateRangeFilter($q, $from, $to);
            }
        ], "rating")
            ->orderBy("reviews_avg_rating", "desc");
    }

    public function scopeminReviews(Builder $query, int $minReviews):Builder | QueryBuilder{
        return $query->having("reviews_count", ">=", $minReviews);
    }
    private function dateRangeFilter(Builder $query, $from = null, $to = null){
        if($from && !$to){
                $query->where("created_at", ">=", $from);
            }else if(!$from && $to){
                $query->where("created_at", "<=", $to);
            }else if($from && $to){
                $query->whereBetween("created_at", [$from, $to]);
            }
    }

    public function scopePopularLastMonth(Builder $query):Builder | QueryBuilder{
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minReviews(2);
    }

    public function scopePopularLast6Months(Builder $query):Builder | QueryBuilder{
        return $query->popular(now()->subMonth(6), now())
            ->highestRated(now()->subMonth(6), now())
            ->minReviews(5);
    }

    public function scopeHighestRatedLastMonth(Builder $query):Builder | QueryBuilder{
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->minReviews(2);
    }

    public function scopeHighestRated6LastMonths(Builder $query):Builder | QueryBuilder{
        return $query->highestRated(now()->subMonth(6), now())
            ->popular(now()->subMonth(6), now())
            ->minReviews(5);
    }
}
