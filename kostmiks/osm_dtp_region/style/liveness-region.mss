@damas-candidate-0: #ff4400;
@damas-candidate-1: #f66602;
@damas-candidate-2: #eb8006;
@damas-candidate-3: #df960d;
@damas-candidate-4: #d1aa15;
@damas-candidate-5: #c1bc1d;
@damas-candidate-6: #adce24;
@damas-candidate-7: #95df2c;
@damas-candidate-8: #73ef33;
@damas-candidate-9: #34ff3b;


#damas-area-prime{
  opacity: 0.5;
  line-color: black;
  line-opacity: 1;
  line-width: 1;
  [candidate_level = 0]{
    polygon-fill: @damas-candidate-0;
  }
  [candidate_level = 1]{
    polygon-fill: @damas-candidate-1;
  }
  [candidate_level = 2]{
    polygon-fill: @damas-candidate-2;
  }
  [candidate_level = 3]{
    polygon-fill: @damas-candidate-3;
  }
  [candidate_level = 4]{
    polygon-fill: @damas-candidate-4;
  }
  [candidate_level = 5]{
    polygon-fill: @damas-candidate-5;
  }
  [candidate_level = 6]{
    polygon-fill: @damas-candidate-6;
  }
  [candidate_level = 7]{
    polygon-fill: @damas-candidate-7;
  }
  [candidate_level = 8]{
    polygon-fill: @damas-candidate-8;
  }
  [candidate_level = 9]{
    polygon-fill: @damas-candidate-9;
  }
}