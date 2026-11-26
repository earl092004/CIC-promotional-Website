<?php

namespace App\Support;

final class CicImageCatalog
{
    public static function all(): array
    {
        return [
            ['file' => 'CIC Amphi 2-edited.jpg', 'title' => 'CIC amphitheater', 'alt' => 'CIC amphitheater interior and seating area'],
            ['file' => 'CIC Amphi 3-edited.jpg', 'title' => 'CIC amphitheater', 'alt' => 'CIC amphitheater interior with blue and red accents'],
            ['file' => 'CIC Clinic Office inside 1-edited.jpg', 'title' => 'CIC clinic office', 'alt' => 'Inside view of a CIC clinic office'],
            ['file' => 'CIC Clinic Office inside 2 -edited.jpg', 'title' => 'CIC clinic office', 'alt' => 'CIC clinic office interior'],
            ['file' => 'CIC Computer Laboratory 2-edited.jpg', 'title' => 'CIC computer laboratory', 'alt' => 'CIC computer laboratory with desktop stations'],
            ['file' => 'CIC Computer laboratory-edited.jpg', 'title' => 'CIC computer laboratory', 'alt' => 'CIC computer laboratory interior'],
            ['file' => 'CIC Libarary Inside-edited.jpg', 'title' => 'CIC library', 'alt' => 'Inside view of the CIC library'],
            ['file' => 'CIC Libary Inside-edited.jpg', 'title' => 'CIC library', 'alt' => 'CIC library interior'],
            ['file' => 'CIC Library Book area-edited.jpg', 'title' => 'CIC library book area', 'alt' => 'CIC library book and study area'],
            ['file' => 'CIC Library Inside-edited.jpg', 'title' => 'CIC library', 'alt' => 'CIC library with study tables'],
            ['file' => 'CIC Medical Technology insdie 4-edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory interior'],
            ['file' => 'CIC Medical Technology inside -edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory equipment'],
            ['file' => 'CIC Medical Technology inside 5-edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory work area'],
            ['file' => 'CIC Medical Technology inside 6-edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory view'],
            ['file' => 'CIC Medical Technology1-edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory equipment setup'],
            ['file' => 'CIC Medical Technology2-edited.jpg', 'title' => 'Medical technology laboratory', 'alt' => 'CIC medical technology laboratory station'],
            ['file' => 'CIC Mental Health month-edited.jpg', 'title' => 'Mental health month at CIC', 'alt' => 'CIC mental health month presentation and community activity'],
            ['file' => 'CIC Radtech Office With Bed inside-edited.jpg', 'title' => 'Radiologic technology office', 'alt' => 'CIC radiologic technology office with imaging bed'],
            ['file' => 'CIC Radtech office inside-edited.jpg', 'title' => 'Radiologic technology office', 'alt' => 'Inside view of the CIC radiologic technology office'],
            ['file' => 'CIC Radtech office with bed inisde 3-edited.jpg', 'title' => 'Radiologic technology facility', 'alt' => 'CIC radiologic technology facility with bed'],
            ['file' => 'Inside CIC Logo, mission Vision 2-edited.jpg', 'title' => 'CIC mission and vision', 'alt' => 'CIC logo displayed with mission and vision information'],
            ['file' => 'Inside CIC Logo, mission Vision Side View-edited.jpg', 'title' => 'CIC mission and vision', 'alt' => 'Side view of CIC mission and vision display'],
            ['file' => 'Inside CIC Logo, mission Vision-edited.jpg', 'title' => 'CIC mission and vision', 'alt' => 'CIC mission and vision display inside the campus'],
            ['file' => 'Inside CIC inside View -edited.jpg', 'title' => 'Inside CIC', 'alt' => 'Interior view of the CIC campus'],
            ['file' => 'Outside CIC View 2-edited.jpg', 'title' => 'CIC campus exterior', 'alt' => 'Exterior view of the City of Ilagan College campus'],
            ['file' => 'Outside CIC View front 4-edited.jpg', 'title' => 'CIC front entrance', 'alt' => 'Front entrance view of the City of Ilagan College campus'],
            ['file' => 'Outside CIC View-edited.jpg', 'title' => 'CIC campus exterior', 'alt' => 'City of Ilagan College campus exterior'],
            ['file' => 'Outside CIC View-edited.png', 'title' => 'CIC campus exterior', 'alt' => 'City of Ilagan College campus exterior'],
        ];
    }

    public static function url(string $file): string
    {
        return asset('images/CIC-Website-Images/'.rawurlencode($file));
    }

    public static function forProgram(string $slug): array
    {
        $programFiles = [
            'bs-medical-technology' => [
                'CIC Medical Technology insdie 4-edited.jpg',
                'CIC Medical Technology inside -edited.jpg',
                'CIC Medical Technology inside 5-edited.jpg',
                'CIC Medical Technology inside 6-edited.jpg',
                'CIC Medical Technology1-edited.jpg',
                'CIC Medical Technology2-edited.jpg',
            ],
            'bs-radiologic-technology' => [
                'CIC Radtech office inside-edited.jpg',
                'CIC Radtech Office With Bed inside-edited.jpg',
                'CIC Radtech office with bed inisde 3-edited.jpg',
            ],
            'bs-information-system' => [
                'CIC Computer Laboratory 2-edited.jpg',
                'CIC Computer laboratory-edited.jpg',
            ],
            'bs-psychology' => [
                'CIC Mental Health month-edited.jpg',
                'CIC Clinic Office inside 1-edited.jpg',
                'CIC Clinic Office inside 2 -edited.jpg',
            ],
        ];

        $catalog = collect(self::all())->keyBy('file');

        return collect($programFiles[$slug] ?? ['Inside CIC inside View -edited.jpg'])
            ->map(fn (string $file) => $catalog->get($file))
            ->filter()
            ->values()
            ->all();
    }
}
