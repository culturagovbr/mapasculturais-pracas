<?php
namespace Pracas;
use MapasCulturais\Themes\BaseV1;
use MapasCulturais\App;

class Theme extends BaseV1\Theme{

    protected static function _getTexts(){
        $app = App::i();
        $self = $app->view;
        $url_search_agents = $self->searchAgentsUrl;
        $url_search_spaces = $self->searchSpacesUrl;
        $url_search_events = $self->searchEventsUrl;
        $url_search_projects = $self->searchProjectsUrl;

        return [
            'site: name' => 'E-Praças',
            'site: description' => 'Novo sistema de gestão dos CEUS',
            'site: in the region' => 'na região',
            'site: of the region' => 'da região',
            'site: owner' => 'DINC',
            'site: by the site owner' => 'pelo Ministério da Cultura',

            'home: title' => "Bem-vind@!",
            'home: abbreviation' => "Praça",
            'home: welcome' => "Página para visualização e cadastro de atividades dos CEUS.",
            'home: events' => "Você pode pesquisar eventos culturais nos campos de busca combinada. Como usuário cadastrado, você pode incluir seus eventos na plataforma e divulgá-los gratuitamente.",
            'home: spaces' => "Procure por espaços culturais incluídos na plataforma, acessando os campos de busca combinada que ajudam na precisão de sua pesquisa. Cadastre também os espaços onde desenvolve suas atividades artísticas e culturais.",

            'search: verified results' => 'Resultados Verificados',
            'search: verified' => "Verificados",

            'entities: Space' => 'Praça',
            'entities: Spaces' => 'Praças',
            'entities: My Spaces' => 'Minhas Praças',
            'entities: My spaces' => 'Minhas praças',
            'entities: no registered spaces' => 'nenhuma praça cadastrada',
            'entities: no spaces' => 'nenhuma praça',
            'entities: new space' => 'nova praça'
        ];
    }

    static function getThemeFolder() {
        return __DIR__;
    }

    function _init() {
        parent::_init();
        $app = App::i();

        $app->hook('API.<<*>>(space).query', function(&$data, &$select_properties, &$dql_joins, &$dql_where) {
            $dql_where .= ' AND e._type = 132';
        });

        $app->hook('view.render(<<*>>):before', function() use($app) {
            $this->_publishAssets();
        });
    }

    protected function _publishAssets() {
        $this->jsObject['assets']['logo-instituicao'] = $this->asset('img/logo-instituicao.png', false);
    }

}
