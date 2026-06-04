<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{
    const QUESTIONS = [
        [
            'id'      => 'brillance',
            'texte'   => 'How does your skin look by midday?',
            'options' => [
                'tres_brillante' => 'Very shiny all over',
                'zone_t'         => 'Shiny only on forehead, nose and chin (T-zone)',
                'normale'        => 'Neither shiny nor dry',
                'seche'          => 'Feels tight and dry',
            ],
        ],
        [
            'id'      => 'pores',
            'texte'   => 'Are your pores visible?',
            'options' => [
                'tres_visibles' => 'Very visible all over',
                'zone_t_only'   => 'Visible mainly on the T-zone',
                'peu_visibles'  => 'Barely visible',
                'invisibles'    => 'Almost invisible',
            ],
        ],
        [
            'id'      => 'reaction',
            'texte'   => 'How does your skin react to new products?',
            'options' => [
                'rougeurs'   => 'Frequent redness and irritation',
                'parfois'    => 'Occasional mild reactions',
                'rarement'   => 'Rarely any reaction',
                'jamais'     => 'Never any problem',
            ],
        ],
        [
            'id'      => 'hydratation',
            'texte'   => 'After washing your face, how does your skin feel?',
            'options' => [
                'tiraillements' => 'Very tight and uncomfortable',
                'un_peu'        => 'Slightly dry',
                'bien'          => 'Fine, no particular feeling',
                'gras'          => 'Gets oily quickly',
            ],
        ],
        [
            'id'      => 'problemes',
            'texte'   => 'What is your main skin concern?',
            'options' => [
                'acne'       => 'Acne and frequent breakouts',
                'secheresse' => 'Dryness and flaking',
                'rougeurs'   => 'Redness and sensitivity',
                'eclat'      => 'Dull, lack of radiance',
                'aucun'      => 'No particular concern',
            ],
        ],
    ];

    public function index(): View
    {
        return view('client.questionnaire.index', [
            'questions' => self::QUESTIONS,
        ]);
    }

    public function analyser(Request $request): View
    {
        $reponses = $request->only(['brillance', 'pores', 'reaction', 'hydratation', 'problemes']);

        $typePeau = $this->detecterTypePeau($reponses);

        $request->user()->update(['type_peau' => $typePeau]);

        $conseils = collect();

        $produits = Produit::where('actif', true)
            ->where('stock', '>', 0)
            ->where(function ($q) use ($typePeau) {
                $q->whereNull('types_peau')
                  ->orWhereJsonContains('types_peau', $typePeau);
            })
            ->with('categorie')
            ->take(4)
            ->get();

        $services = Service::where('actif', true)
            ->where(function ($q) use ($typePeau) {
                $q->whereNull('types_peau')
                  ->orWhereJsonContains('types_peau', $typePeau);
            })
            ->take(3)
            ->get();

        $infosTypePeau = $this->infosTypePeau($typePeau);

        return view('client.questionnaire.resultat', compact(
            'typePeau', 'conseils', 'produits', 'services', 'infosTypePeau', 'reponses'
        ));
    }

    private function detecterTypePeau(array $reponses): string
    {
        $scores = [
            'grasse'   => 0,
            'seche'    => 0,
            'mixte'    => 0,
            'sensible' => 0,
            'normale'  => 0,
        ];

        match ($reponses['brillance'] ?? '') {
            'tres_brillante' => $scores['grasse'] += 3,
            'zone_t'         => $scores['mixte'] += 3,
            'normale'        => $scores['normale'] += 2,
            'seche'          => $scores['seche'] += 3,
            default          => null,
        };

        match ($reponses['pores'] ?? '') {
            'tres_visibles' => $scores['grasse'] += 2,
            'zone_t_only'   => $scores['mixte'] += 2,
            'peu_visibles'  => $scores['normale'] += 1,
            'invisibles'    => $scores['seche'] += 1,
            default         => null,
        };

        match ($reponses['reaction'] ?? '') {
            'rougeurs' => $scores['sensible'] += 3,
            'parfois'  => $scores['sensible'] += 1,
            'rarement' => $scores['normale'] += 1,
            'jamais'   => $scores['normale'] += 2,
            default    => null,
        };

        match ($reponses['hydratation'] ?? '') {
            'tiraillements' => $scores['seche'] += 3,
            'un_peu'        => $scores['seche'] += 1,
            'bien'          => $scores['normale'] += 2,
            'gras'          => $scores['grasse'] += 2,
            default         => null,
        };

        match ($reponses['problemes'] ?? '') {
            'acne'       => $scores['grasse'] += 2,
            'secheresse' => $scores['seche'] += 2,
            'rougeurs'   => $scores['sensible'] += 2,
            'eclat'      => $scores['normale'] += 1,
            'aucun'      => $scores['normale'] += 2,
            default      => null,
        };

        arsort($scores);
        return array_key_first($scores);
    }

    private function infosTypePeau(string $typePeau): array
    {
        return match ($typePeau) {
            'grasse' => [
                'icon'        => '💧',
                'label'       => 'Oily Skin',
                'couleur'     => 'blue',
                'description' => 'Your skin produces excess sebum, giving it a shiny appearance and making it prone to blackheads and blemishes.',
                'routine_am'  => ['Purifying gel cleanser', 'Anti-sebum serum', 'Lightweight non-comedogenic moisturizer', 'SPF 30+'],
                'routine_pm'  => ['Double cleanse', 'Salicylic acid serum', 'Light mattifying moisturizer'],
                'eviter'      => ['Heavy oils', 'Thick creams', 'Excess alcohol', 'Dehydrating soap'],
            ],
            'seche' => [
                'icon'        => '🌵',
                'label'       => 'Dry Skin',
                'couleur'     => 'yellow',
                'description' => 'Your skin lacks lipids and hydration, which can cause tightness, flaking, and a dull complexion.',
                'routine_am'  => ['Gentle cream cleanser', 'Hyaluronic acid serum', 'Rich nourishing cream', 'SPF 30+'],
                'routine_pm'  => ['Oil cleanser', 'Repair serum', 'Rich night cream', 'Face oil (optional)'],
                'eviter'      => ['Foaming cleansers', 'Alcohol-based products', 'Strong acids', 'Hot water'],
            ],
            'mixte' => [
                'icon'        => '☯️',
                'label'       => 'Combination Skin',
                'couleur'     => 'purple',
                'description' => 'Your skin is oily in the T-zone (forehead, nose, chin) and normal to dry on the cheeks. It needs a balanced routine.',
                'routine_am'  => ['Balancing cleanser', 'Light hydrating serum', 'Mattifying moisturizer', 'SPF 30+'],
                'routine_pm'  => ['Gentle cleanser', 'Niacinamide serum', 'Zone-specific moisturizer'],
                'eviter'      => ['Too-rich products on T-zone', 'Too-drying products on cheeks'],
            ],
            'sensible' => [
                'icon'        => '🌸',
                'label'       => 'Sensitive Skin',
                'couleur'     => 'pink',
                'description' => 'Your skin reacts easily to products and environmental factors. It needs gentle, soothing care.',
                'routine_am'  => ['Fragrance-free cleanser', 'Calming serum', 'Soothing moisturizer', 'Mineral SPF 50+'],
                'routine_pm'  => ['Gentle micellar water', 'Centella asiatica serum', 'Barrier repair cream'],
                'eviter'      => ['Fragrances', 'Strong acids', 'Concentrated retinol', 'Abrasive exfoliants', 'Alcohol'],
            ],
            default => [
                'icon'        => '🌿',
                'label'       => 'Normal Skin',
                'couleur'     => 'green',
                'description' => 'You are lucky to have balanced skin! It is neither too oily nor too dry and responds well to most products.',
                'routine_am'  => ['Gentle cleanser', 'Vitamin C serum', 'Light moisturizer', 'SPF 30+'],
                'routine_pm'  => ['Gentle cleanser', 'Retinol serum (2-3x/week)', 'Night moisturizer'],
                'eviter'      => ['Overloading with products', 'Changing routine too often'],
            ],
        };
    }
}
