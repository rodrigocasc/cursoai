<?php
namespace App\core;

    class Model {
        public string | int | null $id;
        public string $created_at;
        public string | null $updated_at;
        public string | null $deleted_at;
    }