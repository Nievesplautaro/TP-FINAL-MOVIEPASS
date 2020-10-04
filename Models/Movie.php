<?php

namespace Models;

    class Movie{

    private $popularity;
    private $vote_count;
    private $poster_path;
    private $id;
    private $backdrop_path;
    private $original_language;
    private $genre_ids;
    private $title;
    private $vote_average;
    private $overview;
    private $release_date;

    public function __construct($popularity,$vote_count,$poster_path,$id,$backdrop_path,$original_language,$genre_ids,$title,$vote_average,$overview,$release_date){
        $this->popularity = $popularity;
        $this->vote_count = $vote_count;
        $this->poster_path = $poster_path;
        $this->id = $id;
        $this->backdrop_path = $backdrop_path;
        $this->original_language = $original_language;
        $this->vote_average = $vote_average;
        $this->overview = $overview;
        $this->release_date = $release_date;
        $this->genre_ids = $genre_ids;
        $this->title = $title;
    }
    
    public function getPopularity()
    {
        return $this->popularity;
    }

    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getVote_count()
    {
        return $this->vote_count;
    }

    public function setVote_count($vote_count)
    {
        $this->vote_count = $vote_count;

        return $this;
    }

    public function getPoster_path()
    {
        return $this->poster_path;
    }

    public function setPoster_path($poster_path)
    {
        $this->poster_path = $poster_path;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getBackdrop_path()
    {
        return $this->backdrop_path;
    }

    public function setBackdrop_path($backdrop_path)
    {
        $this->backdrop_path = $backdrop_path;

        return $this;
    }

    public function getOriginal_language()
    {
        return $this->original_language;
    }

    public function setOriginal_language($original_language)
    {
        $this->original_language = $original_language;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getVote_average()
    {
        return $this->vote_average;
    }

    public function setVote_average($vote_average)
    {
        $this->vote_average = $vote_average;

        return $this;
    }

    public function getOverview()
    {
        return $this->overview;
    }

    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    public function getRelease_date()
    {
        return $this->release_date;
    }

    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }
    }
?>