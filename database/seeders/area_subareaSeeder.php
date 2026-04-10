<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\Models\Area;
use App\Models\Subarea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class area_subareaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
        $areas = [
            'AGRONOMIA',
            'CIÊNCIA E TECNOLOGIA DE ALIMENTOS',
            'RECURSOS PESQUEIROS E ENGENHARIA DE PESCA',
            'ZOOTECNIA',
            'BIOLOGIA',
            'ENSINO DE CIÊNCIAS E BIOLOGIA',
            'EDUCAÇÃO FÍSICA',
            'NUTRIÇÃO',
            'CIÊNCIA DA COMPUTAÇÃO',    
            'FÍSICA',
            'QUÍMICA',
            'MATEMÁTICA',
            'GEOCIÊNCIAS',  

            'EDUCAÇÃO',
            'GEOGRAFIA',
            'HISTÓRIA',
            'ADMINISTRAÇÃO',
            'ARQUITETURA E URBANISMO',
            'GASTRONOMIA',
            'DIREITO',
            'HOTELARIA',

        ];

        foreach ($areas as $nome) {
            Area::firstOrCreate(['nome' => $nome]);
        }

        $subareas = [
            /*
            ================= AGRONOMIA =================
            */
            ['area' => 'AGRONOMIA', 'nome' => 'ENGENHARIA AGRÍCOLA'],
            ['area' => 'AGRONOMIA', 'nome' => 'CIÊNCIAS ECONÔMICAS, SOCIAIS E PROCESSAMENTO DE PRODUTOS'],
            ['area' => 'AGRONOMIA', 'nome' => 'CIÊNCIA DO SOLO'],
            ['area' => 'AGRONOMIA', 'nome' => 'FITOSSANIDADE'],
            ['area' => 'AGRONOMIA', 'nome' => 'FITOTECNIA'],

            /*
            ================= ALIMENTOS =================
            */
            ['area' => 'CIÊNCIA E TECNOLOGIA DE ALIMENTOS', 'nome' => 'CIÊNCIA DE ALIMENTOS'],
            ['area' => 'CIÊNCIA E TECNOLOGIA DE ALIMENTOS', 'nome' => 'TECNOLOGIA DE ALIMENTOS'],

            /*
            ================= PESCA =================
            */
            ['area' => 'RECURSOS PESQUEIROS E ENGENHARIA DE PESCA', 'nome' => 'AQÜICULTURA'],

            /*
            ================= ZOOTECNIA =================
            */
            ['area' => 'ZOOTECNIA', 'nome' => 'NUTRIÇÃO, ALIMENTAÇÃO E PRODUÇÃO ANIMAL'],
            ['area' => 'ZOOTECNIA', 'nome' => 'ECOLOGIA DOS ANIMAIS DOMÉSTICOS E ETOLOGIA'],
            ['area' => 'ZOOTECNIA', 'nome' => 'GENÉTICA E MELHORAMENTO DOS ANIMAIS DOMÉSTICOS'],
            ['area' => 'ZOOTECNIA', 'nome' => 'PASTAGEM E FORRAGICULTURA'],
            ['area' => 'ZOOTECNIA', 'nome' => 'PRODUÇÃO ANIMAL'],

             /*
            ================= BIOLOGIA =================
            */
            ['area' => 'BIOLOGIA', 'nome' => 'BIOLOGIA GERAL'],
            ['area' => 'BIOLOGIA', 'nome' => 'BIOQUÍMICA E BIOLOGIA MOLECULAR'],
            ['area' => 'BIOLOGIA', 'nome' => 'ENSINO DE CIÊNCIAS E BIOLOGIA'],


              /*
            =================  EDUCAÇÃO FÍSICA =================
            */
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'BASES ANÁTOMO-FISIOLÓGICA E BIOMECÂNICA DO MOVIMENTO'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'ESPORTES AQUÁTICOS'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'METODOLOGIA DOS ESPORTES COLETIVOS'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'EDUCAÇÃO FÍSICA PARA GRUPOS ESPECIAIS'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'ESPORTES INDIVIDUAIS E DA NATUREZA'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'TREINAMENTO FÍSICO-ESPORTIVO'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'GINÁSTICA E ATIVIDADES RÍTMICAS -EXPRESSIVAS'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'APRENDIZAGEM E DESENVOLVIMENTO HUMANO'],
            ['area' => 'EDUCAÇÃO FÍSICA', 'nome' => 'LAZER, JOGOS E RECREAÇÃO'],


             /*
            ================= NUTRICAO =================
            */
            ['area' => 'NUTRIÇÃO', 'nome' => 'BIOQUÍMICA DA NUTRIÇÃO'],
            ['area' => 'NUTRIÇÃO', 'nome' => 'DIETÉTICA'],
            ['area' => 'NUTRIÇÃO', 'nome' => 'ANÁLISE NUTRICIONAL DE POPULAÇÃO'],
            ['area' => 'NUTRIÇÃO', 'nome' => 'DESNUTRIÇÃO E DESENVOLVIMENTO FISIOLÓGICO'],

            /*
            ================= COMPUTAÇÃO =================
            */
            ['area' => 'CIÊNCIA DA COMPUTAÇÃO', 'nome' => 'TEORIA DA COMPUTAÇÃO'],
            ['area' => 'CIÊNCIA DA COMPUTAÇÃO', 'nome' => 'METODOLOGIA E TÉCNICAS DA COMPUTAÇÃO'],
            ['area' => 'CIÊNCIA DA COMPUTAÇÃO', 'nome' => 'SISTEMAS DE COMPUTAÇÃO'],

            /*
            ================= FISICA =================
            */
            ['area' => 'FÍSICA', 'nome' => 'ÁREAS CLÁSSICAS DE FENOMENOLOGIA E SUAS APLICAÇÕES'],
            ['area' => 'FÍSICA', 'nome' => 'FÍSICA DA MATÉRIA CONDENSADA'],
            ['area' => 'FÍSICA', 'nome' => 'FÍSICA GERAL E EXPERIMENTAL'],

            // ================= GEOCIÊNCIAS =================
            ['area' => 'GEOCIÊNCIAS', 'nome' => 'GEOGRAFIA FÍSICA'],

            // ================= MATEMÁTICA =================
            ['area' => 'MATEMÁTICA', 'nome' => 'ÁLGEBRA'],
            ['area' => 'MATEMÁTICA', 'nome' => 'ANÁLISE'],
            ['area' => 'MATEMÁTICA', 'nome' => 'MATEMÁTICA APLICADA'],
            ['area' => 'MATEMÁTICA', 'nome' => 'MATEMÁTICA BÁSICA'],

              // ================= QUÍMICA =================
            ['area' => 'QUÍMICA', 'nome' => 'QUÍMICA ORGÂNICA'],
            ['area' => 'QUÍMICA', 'nome' => 'QUÍMICA INORGÂNICA'],
            ['area' => 'QUÍMICA', 'nome' => 'FÍSICO-QUÍMICA'],
            ['area' => 'QUÍMICA', 'nome' => 'QUÍMICA ANALÍTICA'],
            ['area' => 'QUÍMICA', 'nome' => 'QUÍMICA GERAL'],


            // ================= EDUCAÇÃO =================
            ['area' => 'EDUCAÇÃO', 'nome' => 'FUNDAMENTOS DA EDUCAÇÃO, POLÍTICA E GESTÃO EDUCACIONAL'],
            ['area' => 'EDUCAÇÃO', 'nome' => ' CURRÍCULO E ESTUDOS APLICADOS AO ENSINO E APRENDIZAGEM'],
           
             // ================= GEOGRAFIA =================
            ['area' => 'GEOGRAFIA', 'nome' => 'GEOGRAFIA HUMANA'],
           
            // ================= HISTÓRIA =================
            ['area' => 'HISTÓRIA', 'nome' => 'HISTÓRIA GERAL, DA AMÉRICA, DO BRASIL, DO CEARÁ E DA ARTE'],
           
            
            // ================= ADMINISTRAÇÃO =================
            ['area' => 'ADMINISTRAÇÃO', 'nome' => 'ADMINISTRAÇÃO DE EMPRESAS'],
            ['area' => 'ADMINISTRAÇÃO', 'nome' => 'CIÊNCIAS CONTÁBEIS'],
            
            // =================  ARQUITETURA E URBANISMO =================
            ['area' => 'ARQUITETURA E URBANISMO', 'nome' => 'ARQUITETURA E URBANISMO'],
           
            // =================  DIREITO =================
            ['area' => 'DIREITO', 'nome' => 'DIREITO PÚBLICO E PRIVADO'],
           
             // =================  GASTRONOMIA =================
            ['area' => 'GASTRONOMIA', 'nome' => 'COZINHA II'],
            ['area' => 'GASTRONOMIA', 'nome' => 'COZINHA I'],
            ['area' => 'GASTRONOMIA', 'nome' => 'HABILIDADE E TÉCNICAS CULINÁRIAS'],
          
            // =================  HOTELARIA =================
            ['area' => 'HOTELARIA', 'nome' => ' HOSPEDAGEM, RESTAURANTE E BAR'],
           
            
          
        ];

        foreach ($subareas as $item) {
                $area = Area::where('nome', $item['area'])->first();

                if ($area) {
                    Subarea::firstOrCreate([
                        'nome' => $item['nome'],
                        'area_id' => $area->id
                    ]);
                }
            }
    }
}
