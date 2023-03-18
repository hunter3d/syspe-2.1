<?php

namespace App\Http\Requests;

use App\Models\Exhibition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ExhibitionsFormRequest extends FormRequest {
    public function rules(): array {
        return [
            'name'          => [ 'required', 'string' ],
            'description'   => [ 'nullable', 'string' ],
            'logo'          => [ 'nullable', 'image', 'mimes:jpeg,png,jpg' ],
            'template'      => [ 'required', 'boolean' ],
        ];
    }

    public function attributes(): array {
        return [
            'name'          => 'Название',
            'description'   => 'Описание',
            'logo'          => 'Логотип',
            'template'      => 'Статус',
        ];
    }

    public function authorize(): bool {
        return Auth::check();
    }

    public function store() {
        // обрабатываем логотип
        if ( $this->file( 'logo' ) ) {
            $image = $this->file( 'logo' );
            $logo_name = Str::random( 3 ) . substr( time(), 6, 8 ) . Str::random( 3 ) . '.' . $image->extension();
            $logo_path = 'storage/exhibitions';
            $image->move( public_path( $logo_path ), $logo_name );
            // crop image
            if ( $this->input( 'crop_x1' ) != '' ) {
                $scale = $this->input( 'crop_ow' ) / $this->input( 'crop_w' );
                $w = round( $this->input( 'crop_x2' ) * $scale ) - round( $this->input( 'crop_x1' ) * $scale );
                $h = round( $this->input( 'crop_y2' ) * $scale ) - round( $this->input( 'crop_y1' ) * $scale );
                $x = round( $this->input( 'crop_x1' ) * $scale );
                $y = round( $this->input( 'crop_y1' ) * $scale );
                $img = Image::make( public_path( $logo_path ) . '/' . $logo_name )->crop( $w, $h, $x, $y )->resize( 330, 330 )->save();
            } else {
                $img = Image::make( public_path( $logo_path ) . '/' . $logo_name )->resize( 330, 330 )->save();
            }
        } else {
            $logo_name = 'pe_exhibition_template.svg';
            $logo_path = 'storage/templates';
        }

        // Пихаем в базу
        $ex = Exhibition::create( [
            'name'          => $this->input( 'name' ),
            'description'   => $this->input( 'description' ),
            'logo_path'     => $logo_path,
            'logo_name'     => $logo_name,
            'template'      => $this->input( 'template' ),
        ] );
    }

    public function update( $id ) {
        $exhb = Exhibition::find( $id );

        // обрабатываем логотип
        if ( $this->file( 'logo' ) ) {
            $image = $this->file( 'logo' );
            $logo_name = Str::random( 3 ) . substr( time(), 6, 8 ) . Str::random( 3 ) . '.' . $image->extension();
            $logo_path = 'storage/exhibitions';
            $image->move( public_path( $logo_path ), $logo_name );
            // crop image
            if ( $this->input( 'crop_x1' ) != '' ) {
                $scale = $this->input( 'crop_ow' ) / $this->input( 'crop_w' );
                $w = round( $this->input( 'crop_x2' ) * $scale ) - round( $this->input( 'crop_x1' ) * $scale );
                $h = round( $this->input( 'crop_y2' ) * $scale ) - round( $this->input( 'crop_y1' ) * $scale );
                $x = round( $this->input( 'crop_x1' ) * $scale );
                $y = round( $this->input( 'crop_y1' ) * $scale );
                $img = Image::make( public_path( $logo_path ) . '/' . $logo_name )->crop( $w, $h, $x, $y )->resize( 150, 150 )->save();
            } else {
                $img = Image::make( public_path( $logo_path ) . '/' . $logo_name )->resize( 150, 150 )->save();
            }
        } else {
            $logo_name = $exhb->logo_name;
            $logo_path = $exhb->logo_path;
        }

        // Пихаем в базу
        $exhb->name = $this->input( 'name' );
        $exhb->description = $this->input( 'description' );
        $exhb->template = $this->input( 'template' );

        // Удаляем старый логотип
        if ( $exhb->logo_name != $logo_name && $exhb->logo_name != 'pe_exhibition_template.svg' ) {
            if ( \File::exists( public_path( $exhb->logo_path ) . '/' . $exhb->logo_name ) ) \File::delete( public_path( $exhb->logo_path ) . '/' . $exhb->logo_name );

        }

        $exhb->logo_name = $logo_name;
        $exhb->logo_path = $logo_path;
        $exhb->save();
    }
}
