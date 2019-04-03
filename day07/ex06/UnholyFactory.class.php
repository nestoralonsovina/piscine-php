<?php


class UnholyFactory
{
    private $fighters = array();
    private $fighters_types = array();

    public function absorb( $obj ) {
         if (get_parent_class($obj) == "Fighter") {

            if (in_array($obj->getType(), $this->fighters_types)) {
                print("(Factory already absorbed a fighter of type " . $obj->getType() . ")" . PHP_EOL);
            } else {
                $this->fighters[] = $obj;
                $this->fighters_types[] = $obj->getType();
                print("(Factory absorbed a fighter of type " . $obj->getType() .")" . PHP_EOL);
            }
        } else {
            print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
        }
    }

    public function fabricate( $rf ) {
        $a = array_search($rf, $this->fighters_types);
        if ($a !== False) {
            print("(Factory fabricates a fighter of type " . $this->fighters_types[$a] .")" . PHP_EOL);
            return ($this->fighters[$a]);
        }
        print("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
        return null;
    }

}