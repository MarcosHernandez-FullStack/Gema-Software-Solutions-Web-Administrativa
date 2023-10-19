<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;
class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::insert(
            [
                [
                    'nombre' => 'DISEÑO WEB',
                    'descripcion_resumida' => 'Expande el alcance de tu marca y deja que todos te vean. Llega a cualquier parte del mundo con un solo click.',
                    'descripcion_amplia' => 'En Gema Software Solutions, nos especializamos en la creación de sitios web a medida que reflejan la esencia de tu marca y brindan una experiencia excepcional a tus visitantes. Nuestros servicios de diseño web incluyen diseño personalizado, diseño responsive para dispositivos móviles, optimización SEO y una destacada experiencia de usuario (UX). Nuestro equipo de diseñadores se esfuerza por crear una interfaz visualmente impactante y una navegación intuitiva. Además, ofrecemos soporte técnico continuo para mantener tu sitio en óptimas condiciones. Estamos comprometidos a ayudarte a destacar en línea. ¡Contáctanos hoy para iniciar tu proyecto de diseño web!',
                    'ruta_foto_principal'=>'public/servicios/principal/DISEÑO WEB.jpg',
                    'ruta_foto_secundaria'=>'public/servicios/secundaria/ECOMMERCE.jpg'
                ],
                [
                    'nombre' => 'SISTEMAS DE INFORMACIÓN',
                    'descripcion_resumida' => 'Simplifica los procesos de tu empresa en un sistema informático.',
                    'descripcion_amplia' => 'Nuestro servicio de Sistemas de Información en GEMA SOFTWARE SOLUTIONS se especializa en optimizar tus procesos empresariales, simplificar la gestión y mantenimiento de sistemas, y proporcionar informes críticos para tomar decisiones fundamentadas. Diseñamos soluciones a medida que automatizan y mejoran tus flujos de trabajo, lo que resulta en una mayor eficiencia operativa. Además, nuestra capacidad para generar informes detallados y análisis en tiempo real te proporciona una ventaja competitiva al tomar decisiones estratégicas basadas en datos precisos. Simplifica la gestión de tu negocio, reduce costos y mejora tu capacidad de toma de decisiones con nuestro servicio de Sistemas de Información.',
                    'ruta_foto_principal'=>'public/servicios/principal/SISTEMAS DE INFORMACIÓN.jpg',
                    'ruta_foto_secundaria'=>'public/servicios/secundaria/ECOMMERCE.jpg'
                ],
                [
                    'nombre' => 'ECOMMERCE',
                    'descripcion_resumida' => 'Ofrece tus productos o servicios en todo el mundo. Deja que los pagos en línea se encarguen de todo.',
                    'descripcion_amplia' => 'Nuestro servicio de eCommerce en GEMA SOFTWARE SOLUTIONS ofrece una solución integral para impulsar tus ventas en línea. Diseñamos y desarrollamos tiendas personalizadas que garantizan una experiencia de compra óptima, con catálogos de productos atractivos, procesos de pago seguros y análisis en tiempo real. Maximiza tus oportunidades de venta, llega a un público global y mejora la visibilidad de tu negocio con nuestra plataforma de eCommerce confiable y adaptable.',
                    'ruta_foto_principal'=>'public/servicios/principal/ECOMMERCE.jpg',
                    'ruta_foto_secundaria'=>'public/servicios/secundaria/ECOMMERCE.jpg'
                ],
                
                
            ]);
    }
}
