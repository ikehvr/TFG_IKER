<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destino;
use App\Models\Itinerario;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //================================
        // 20 DESTINOS
        //================================

        // Cultura
        Destino::create([ 
            'nombre' => 'Templo Kinkaku-ji',
            'ciudad' => 'Kioto',
            'descripcion' => 'El templo Kinkaku-ji, conocido como el pabellón dorado',
            'tipo' => 'cultura',
            'precio_estimado' => 15,
            'imagen_url' => '/images/destinos/kinkakuji.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Fushimi Inari',
            'ciudad' => 'Kioto',
            'descripcion' => 'Santuario famoso por sus miles de arcos torii',
            'tipo' => 'cultura',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/fushimi.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Castillo Himeji',
            'ciudad' => 'Himeji',
            'descripcion' => 'El castillo mejor conservado de Japón',
            'tipo' => 'cultura',
            'precio_estimado' => 10,
            'imagen_url' => '/images/destinos/himeji.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Nara Park',
            'ciudad' => 'Nara',
            'descripcion' => 'Parque famoso por sus ciervos sagrados',
            'tipo' => 'cultura',
            'precio_estimado' => 10,
            'imagen_url' => '/images/destinos/nara.jpg',
            'activo' => true
        ]);

        // Moderno
        Destino::create([
            'nombre' => 'Shibuya Crossing',
            'ciudad' => 'Tokio',
            'descripcion' => 'El cruce más famoso del mundo',
            'tipo' => 'moderno',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/shibuya.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Tokyo Skytree',
            'ciudad' => 'Tokio',
            'descripcion' => 'La torre más alta de Japón',
            'tipo' => 'moderno',
            'precio_estimado' => 20,
            'imagen_url' => '/images/destinos/skytree.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'TeamLab Planets',
            'ciudad' => 'Tokio',
            'descripcion' => 'Museo de arte digital inmersivo',
            'tipo' => 'moderno',
            'precio_estimado' => 40,
            'imagen_url' => '/images/destinos/teamlab.jpg',
            'activo' => true
        ]);

        // Anime
        Destino::create([
            'nombre' => 'Akihabara',
            'ciudad' => 'Tokio',
            'descripcion' => 'El paraíso del anime y la electrónica',
            'tipo' => 'anime',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/akihabara.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Ghibli Museum',
            'ciudad' => 'Mitaka',
            'descripcion' => 'El museo del Studio Ghibli',
            'tipo' => 'anime',
            'precio_estimado' => 10,
            'imagen_url' => '/images/destinos/ghibli.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Nakano Broadway',
            'ciudad' => 'Tokio',
            'descripcion' => 'Centro comercial de culto para coleccionistas',
            'tipo' => 'anime',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/nakano.jpg',
            'activo' => true
        ]);

        // Naturaleza
        Destino::create([
            'nombre' => 'Monte Fuji',
            'ciudad' => 'Shizuoka',
            'descripcion' => 'El icono de Japón',
            'tipo' => 'naturaleza',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/fuji.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Kenrokuen',
            'ciudad' => 'Kanazawa',
            'descripcion' => 'Uno de los tres jardines más bellos de Japón',
            'tipo' => 'naturaleza',
            'precio_estimado' => 10,
            'imagen_url' => '/images/destinos/kenrokuen.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Arashiyama',
            'ciudad' => 'Kioto',
            'descripcion' => 'Famoso bosque de bambú',
            'tipo' => 'NATURALEZA',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/arashiyama.jpg',
            'activo' => true
        ]);

        // Gastronomía
        Destino::create([
            'nombre' => 'Tsukiji Market',
            'ciudad' => 'Tokio',
            'descripcion' => 'El mercado de pescado más famoso',
            'tipo' => 'gastronomia',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/tsukiji.jpg',
            'activo' => true
        ]);

        Destino::create([
            'nombre' => 'Dotonbori',
            'ciudad' => 'Osaka',
            'descripcion' => 'La calle de la comida más vibrante',
            'tipo' => 'gastronomia',
            'precio_estimado' => 0,
            'imagen_url' => '/images/destinos/dotonbori.jpg',
            'activo' => true
        ]);

        //================================
        // ITINERARIOS - 3-4 POR CATEGORÍA
        //================================

        // ===== TRADICIONAL (4 itinerarios) =====
        $it1 = Itinerario::create([
            'titulo' => 'Ruta de Oro: Kioto y Nara',
            'slug' => 'ruta-de-oro-kioto-nara',
            'descripcion_corta' => 'Descubre la esencia de Japón con esta ruta clásica',
            'descripcion_larga' => 'Explora templos antiguos, jardines serenos y la rica cultura japonesa',
            'duracion_dias' => 7,
            'categoria' => 'tradicional',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 1200,
            'imagen_principal' => '/images/itinerarios/kioto-tradicional.jpg',
            'destino_principal' => 'Kioto',
            'recomendado' => true,
            'activo' => true
        ]);

        $it2 = Itinerario::create([
            'titulo' => 'Samuráis y Castillos',
            'slug' => 'samurai-castillos',
            'descripcion_corta' => 'Sumérgete en la era de los samuráis',
            'descripcion_larga' => 'Visita castillos históricos y aprende sobre la cultura samurái',
            'duracion_dias' => 5,
            'categoria' => 'tradicional',
            'presupuesto' => 'medio',
            'primera_vez' => 'no',
            'precio_desde' => 1600,
            'imagen_principal' => '/images/itinerarios/samurai.jpg',
            'destino_principal' => 'Himeji',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_trad3 = Itinerario::create([
            'titulo' => 'Templos de Kioto',
            'slug' => 'templos-kioto',
            'descripcion_corta' => 'Los templos más emblemáticos de la antigua capital',
            'descripcion_larga' => 'Recorre Kinkaku-ji, Ginkaku-ji y el famoso Fushimi Inari',
            'duracion_dias' => 4,
            'categoria' => 'tradicional',
            'presupuesto' => 'económico',
            'primera_vez' => 'si',
            'precio_desde' => 650,
            'imagen_principal' => '/images/itinerarios/kinkakuji.jpg',
            'destino_principal' => 'Kioto',
            'recomendado' => false,
            'activo' => true
        ]);

        $it_trad4 = Itinerario::create([
            'titulo' => 'Nara y sus Ciervos',
            'slug' => 'nara-ciervos',
            'descripcion_corta' => 'Un día en la primera capital de Japón',
            'descripcion_larga' => 'Templo Todai-ji, parque de Nara y santuarios',
            'duracion_dias' => 2,
            'categoria' => 'tradicional',
            'presupuesto' => 'económico',
            'primera_vez' => 'si',
            'precio_desde' => 350,
            'imagen_principal' => '/images/itinerarios/nara.jpg',
            'destino_principal' => 'Nara',
            'recomendado' => false,
            'activo' => true
        ]);

        // ===== MODERNO (4 itinerarios) =====
        $it3 = Itinerario::create([
            'titulo' => 'Tokio Futurista',
            'slug' => 'tokio-futurista',
            'descripcion_corta' => 'Explora el lado más moderno de Tokio',
            'descripcion_larga' => 'Rascacielos, tecnología y luces de neón',
            'duracion_dias' => 5,
            'categoria' => 'moderno',
            'presupuesto' => 'lujo',
            'primera_vez' => 'si',
            'precio_desde' => 2000,
            'imagen_principal' => '/images/itinerarios/tokio-moderno.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_mod2 = Itinerario::create([
            'titulo' => 'Tokio de Noche',
            'slug' => 'tokio-noche',
            'descripcion_corta' => 'Descubre la vida nocturna de Tokio',
            'descripcion_larga' => 'Bares en Shinjuku, karaoke y luces de neón',
            'duracion_dias' => 3,
            'categoria' => 'moderno',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 550,
            'imagen_principal' => '/images/itinerarios/skytree.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_mod3 = Itinerario::create([
            'titulo' => 'Osaka Moderna',
            'slug' => 'osaka-moderna',
            'descripcion_corta' => 'La cocina y la diversión en Osaka',
            'descripcion_larga' => 'Dotonbori, castillo de Osaka y acuario',
            'duracion_dias' => 3,
            'categoria' => 'moderno',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 480,
            'imagen_principal' => '/images/itinerarios/dotonbori.jpg',
            'destino_principal' => 'Osaka',
            'recomendado' => false,
            'activo' => true
        ]);

        $it_mod4 = Itinerario::create([
            'titulo' => 'Yokohama Futurista',
            'slug' => 'yokohama-futurista',
            'descripcion_corta' => 'El puerto futurista junto a Tokio',
            'descripcion_larga' => 'Minato Mirai, China Town y el puente',
            'duracion_dias' => 2,
            'categoria' => 'moderno',
            'presupuesto' => 'económico',
            'primera_vez' => 'no',
            'precio_desde' => 320,
            'imagen_principal' => '/images/itinerarios/teamlab.jpg',
            'destino_principal' => 'Yokohama',
            'recomendado' => false,
            'activo' => true
        ]);

        // ===== ANIME (4 itinerarios) =====
        $it4 = Itinerario::create([
            'titulo' => 'Peregrinaje Otaku',
            'slug' => 'peregrinaje-otaku',
            'descripcion_corta' => 'El viaje definitivo para fans del anime',
            'descripcion_larga' => 'Visita Akihabara, el Museo Ghibli y Nakano Broadway',
            'duracion_dias' => 7,
            'categoria' => 'anime',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 1100,
            'imagen_principal' => '/images/itinerarios/anime-tokyo.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_anime2 = Itinerario::create([
            'titulo' => 'Akihabara Experience',
            'slug' => 'akihabara-experience',
            'descripcion_corta' => 'El paraíso del anime y la electrónica',
            'descripcion_larga' => 'Visita a tiendas de manga, maid cafés y arcades',
            'duracion_dias' => 2,
            'categoria' => 'anime',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 390,
            'imagen_principal' => '/images/itinerarios/akihabara.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_anime3 = Itinerario::create([
            'titulo' => 'Ghibli y Mitaka',
            'slug' => 'ghibli-mitaka',
            'descripcion_corta' => 'El mundo mágico de Miyazaki',
            'descripcion_larga' => 'Museo Ghibli y paseo por el parque Inokashira',
            'duracion_dias' => 1,
            'categoria' => 'anime',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 280,
            'imagen_principal' => '/images/itinerarios/ghibli.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => false,
            'activo' => true
        ]);

        $it_anime4 = Itinerario::create([
            'titulo' => 'Nakano Broadway',
            'slug' => 'nakano-broadway',
            'descripcion_corta' => 'El paraíso de los coleccionistas',
            'descripcion_larga' => 'Mandarake y tiendas de figuras exclusivas',
            'duracion_dias' => 1,
            'categoria' => 'anime',
            'presupuesto' => 'económico',
            'primera_vez' => 'no',
            'precio_desde' => 180,
            'imagen_principal' => '/images/itinerarios/nakano.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => false,
            'activo' => true
        ]);

        // ===== NATURALEZA (4 itinerarios) =====
        $it5 = Itinerario::create([
            'titulo' => 'Alpes Japoneses',
            'slug' => 'alpes-japoneses',
            'descripcion_corta' => 'Explora la belleza natural de los Alpes Japoneses',
            'descripcion_larga' => 'Senderismo, aguas termales y pueblos tradicionales',
            'duracion_dias' => 8,
            'categoria' => 'naturaleza',
            'presupuesto' => 'medio',
            'primera_vez' => 'no',
            'precio_desde' => 900,
            'imagen_principal' => '/images/itinerarios/alpes.jpg',
            'destino_principal' => 'Takayama',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_nat2 = Itinerario::create([
            'titulo' => 'Nikko Naturaleza',
            'slug' => 'nikko-naturaleza',
            'descripcion_corta' => 'Templos y naturaleza en las montañas',
            'descripcion_larga' => 'Santuario Toshogu, puente Shinkyo y cascadas',
            'duracion_dias' => 2,
            'categoria' => 'naturaleza',
            'presupuesto' => 'medio',
            'primera_vez' => 'no',
            'precio_desde' => 420,
            'imagen_principal' => '/images/itinerarios/kenrokuen.jpg',
            'destino_principal' => 'Nikko',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_nat3 = Itinerario::create([
            'titulo' => 'Hakone y Fuji',
            'slug' => 'hakone-fuji',
            'descripcion_corta' => 'Vistas del Monte Fuji y aguas termales',
            'descripcion_larga' => 'Crucero por el lago Ashi, teleférico y onsens',
            'duracion_dias' => 2,
            'categoria' => 'naturaleza',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 380,
            'imagen_principal' => '/images/itinerarios/fuji.jpg',
            'destino_principal' => 'Hakone',
            'recomendado' => false,
            'activo' => true
        ]);

        $it_nat4 = Itinerario::create([
            'titulo' => 'Arashiyama y Bambú',
            'slug' => 'arashiyama-bambu',
            'descripcion_corta' => 'El famoso bosque de bambú de Kioto',
            'descripcion_larga' => 'Bosque de bambú, templo Tenryu-ji y puente Togetsukyo',
            'duracion_dias' => 1,
            'categoria' => 'naturaleza',
            'presupuesto' => 'económico',
            'primera_vez' => 'si',
            'precio_desde' => 220,
            'imagen_principal' => '/images/itinerarios/arashiyama.jpg',
            'destino_principal' => 'Kioto',
            'recomendado' => false,
            'activo' => true
        ]);

        // ===== MIXTO (2 itinerarios) =====
        $it6 = Itinerario::create([
            'titulo' => 'Gran Tour de Japón',
            'slug' => 'gran-tour-japon',
            'descripcion_corta' => 'Lo mejor de Japón en un solo viaje',
            'descripcion_larga' => 'Tokio, Kioto, Osaka y más en un recorrido completo',
            'duracion_dias' => 14,
            'categoria' => 'mixto',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 2200,
            'imagen_principal' => '/images/itinerarios/gran-tour.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => true,
            'activo' => true
        ]);

        $it_mix2 = Itinerario::create([
            'titulo' => 'Esenciales de Japón',
            'slug' => 'esenciales-japon',
            'descripcion_corta' => 'Lo imprescindible en una semana',
            'descripcion_larga' => 'Tokio, Monte Fuji y Kioto en 7 días',
            'duracion_dias' => 7,
            'categoria' => 'mixto',
            'presupuesto' => 'medio',
            'primera_vez' => 'si',
            'precio_desde' => 1400,
            'imagen_principal' => '/images/itinerarios/esenciales.jpg',
            'destino_principal' => 'Tokio',
            'recomendado' => false,
            'activo' => true
        ]);

        //==============================
        // Relacionar itinerarios con destinos (IDs CORREGIDOS)
        //==============================

        // Itinerario 1 (Ruta de Oro) - ID 1
        $it1->destinos()->attach([1, 2, 4], ['orden' => 1]);

        // Itinerario 2 (Samuráis) - ID 2
        $it2->destinos()->attach([3, 1, 4], ['orden' => 1]);

        // Itinerario Tradicional 3 (Templos Kioto) - ID 7
        $it_trad3->destinos()->attach([1, 2], ['orden' => 1]);

        // Itinerario Tradicional 4 (Nara) - ID 8
        $it_trad4->destinos()->attach([4], ['orden' => 1]);

        // Itinerario 3 (Tokio Futurista) - ID 3
        $it3->destinos()->attach([5, 6, 7], ['orden' => 1]);

        // Itinerario Moderno 2 (Tokio Noche) - ID 9
        $it_mod2->destinos()->attach([5], ['orden' => 1]);

        // Itinerario Moderno 3 (Osaka) - ID 10
        $it_mod3->destinos()->attach([15], ['orden' => 1]);

        // Itinerario Moderno 4 (Yokohama) - ID 11
        $it_mod4->destinos()->attach([5, 6], ['orden' => 1]);  // Yokohama no tiene destino propio

        // Itinerario 4 (Peregrinaje Otaku) - ID 4
        $it4->destinos()->attach([8, 9, 10], ['orden' => 1]);

        // Itinerario Anime 2 (Akihabara) - ID 12
        $it_anime2->destinos()->attach([8], ['orden' => 1]);

        // Itinerario Anime 3 (Ghibli) - ID 13
        $it_anime3->destinos()->attach([9], ['orden' => 1]);

        // Itinerario Anime 4 (Nakano) - ID 14
        $it_anime4->destinos()->attach([10], ['orden' => 1]);

        // Itinerario 5 (Alpes Japoneses) - ID 5
        $it5->destinos()->attach([11, 12, 13], ['orden' => 1]);

        // Itinerario Naturaleza 2 (Nikko) - ID 15
        $it_nat2->destinos()->attach([11, 13], ['orden' => 1]);  // Nikko usa destinos existentes

        // Itinerario Naturaleza 3 (Hakone) - ID 16
        $it_nat3->destinos()->attach([11, 12], ['orden' => 1]);  // Hakone usa Monte Fuji y Kenrokuen

        // Itinerario Naturaleza 4 (Arashiyama) - ID 17
        $it_nat4->destinos()->attach([13], ['orden' => 1]);

        // Itinerario 6 (Gran Tour) - ID 6
        $it6->destinos()->attach([1, 2, 4, 5, 8, 11, 14, 15], ['orden' => 1]);

        // Itinerario Mixto 2 (Esenciales) - ID 18
        $it_mix2->destinos()->attach([1, 5, 11], ['orden' => 1]);
    }
}