<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'prenom'        => ['required', 'string', 'min:2', 'max:60'],
            'nom'           => ['required', 'string', 'min:2', 'max:60'],
            'email'         => ['required', 'email:rfc'],
            'telephone'     => ['required', 'string', 'min:8', 'max:20'],
            'chambre'       => ['required', 'string'],
            'date_arrivee'  => ['required', 'date', 'after_or_equal:today'],
            'date_depart'   => ['required', 'date', 'after:date_arrivee'],
            'adultes'       => ['required', 'integer', 'min:1', 'max:6'],
            'enfants'       => ['nullable', 'integer', 'min:0', 'max:6'],
            'message'       => ['nullable', 'string', 'max:1000'],
            'petit_dej'     => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'prenom.required'       => 'Votre prénom est requis.',
            'nom.required'          => 'Votre nom est requis.',
            'email.required'        => 'Votre adresse email est requise.',
            'email.email'           => 'L\'adresse email n\'est pas valide.',
            'telephone.required'    => 'Votre numéro de téléphone est requis.',
            'chambre.required'      => 'Veuillez sélectionner un hébergement.',
            'date_arrivee.required' => 'La date d\'arrivée est requise.',
            'date_arrivee.after_or_equal' => 'La date d\'arrivée ne peut pas être dans le passé.',
            'date_depart.required'  => 'La date de départ est requise.',
            'date_depart.after'     => 'La date de départ doit être après la date d\'arrivée.',
            'adultes.required'      => 'Indiquez le nombre d\'adultes.',
            'adultes.min'           => 'Au moins 1 adulte est requis.',
        ];
    }

    /**
     * Calcule le nombre de nuits entre arrivée et départ.
     */
    public function nuits(): int
    {
        $arrivee = new \DateTime($this->date_arrivee);
        $depart  = new \DateTime($this->date_depart);
        return (int) $arrivee->diff($depart)->days;
    }

    /**
     * Retourne le prix de la chambre sélectionnée.
     */
    public function prixChambre(): array
    {
        $chambres = [
            'Suite Supérieure'    => ['eur' => 120, 'fcfa' => 78000],
            'Suite Standard'      => ['eur' => 96,  'fcfa' => 63000],
            'Bungalow Deluxe'     => ['eur' => 74,  'fcfa' => 48000],
            'Bungalow Supérieur'  => ['eur' => 60,  'fcfa' => 39000],
            'Bungalow Standard'   => ['eur' => 38,  'fcfa' => 25000],
            'Chambres B&B'        => ['eur' => 28,  'fcfa' => 18000],
        ];
        return $chambres[$this->chambre] ?? ['eur' => 0, 'fcfa' => 0];
    }
}
