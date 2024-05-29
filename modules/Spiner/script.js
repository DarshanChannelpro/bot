
(function() {
  const wheel = document.querySelector('.wheel');
  const startButton = document.querySelector('.button');
  const back= document.querySelector('.back')
  let deg = 0;
  let c1 = 0; 
  let c2 = 0;
  let c3= 0;
  let c4= 0;
  let c5=0;
  let s1 = 0; 
  let s2 = 0;
  let s3= 0;
  let s4= 0;
  let s5=0;
  let b;
  let pricing = [
    {
      amount: 1,
      arr1: []
    },
    {
      amount: 2,
      arr2: []
    },
    {
      amount: 5,
      arr5: []
    },
    {
      amount: 10,
      arr10: []
    },
    {
      amount: 20,
      arr20: []
    },
    {
      amount: 40,
      arr40: []
    },
  ];
  const items = [
    "40", "1", "2", "1", "5", "2", "1", "10", "1",
    "5", "1", "10", "1", "20", "1", "2", "1",
    "5", "2", "1", "10", "1", "2", "5","1", "2",
    "1","40", "2","5","2", "1","2","1","10","1",
    "5","1","2","1","20", "1", "2","1", "5", "2",
    "1", "10", "1", "2", "5", "1","2", "1"
];

  startButton.addEventListener('click', () => {
    
    // Disable button during spin
    startButton.style.pointerEvents = 'none';
    deg = Math.floor(5000 + Math.random() * 5000);
    console.log(deg)
    wheel.style.transition = 'all 5s ease ';
    back.style.transition = 'all 1s ease-out';
    wheel.style.transform = `rotate(${deg}deg)`;
    wheel.classList.add('blur');
    back.classList.add('rainbow');
  });

  wheel.addEventListener('transitionend', () => {
    wheel.classList.remove('blur');
    back.classList.remove('rainbow');
    startButton.style.pointerEvents = 'auto';
    wheel.style.transition = 'none';
    const actualDeg = deg % 360;
    wheel.style.transform = `rotate(${actualDeg}deg)`;
    var element = document.getElementById("result");
   
    const anglePerItem = 360 / items.length;

    // Adjust the actualDeg to start from 0 to 360
    let adjustedDeg = actualDeg < 0 ? actualDeg + 360 : actualDeg;

    // Calculate the index of the item based on the adjusted degree
    const index = Math.floor(adjustedDeg / anglePerItem);

    document.getElementById("result").textContent = items[index];
    console.log(actualDeg);
    
    console.log(index)
    console.log(items[index])
  }
  
  );

  const tds = document.querySelectorAll('#table td');
  tds.forEach(td => {
    td.addEventListener('click', () => {
      const clickedValue = td.textContent.trim();
      console.log(clickedValue)
    });
  });

  
  
  const tds1 = document.querySelectorAll('#table1 td');
  tds1.forEach(td => {
    td.addEventListener('click', () => {
      const clickedValue1 = td.textContent.trim();
      console.log(clickedValue1)
      if (clickedValue1 == 1) {
        c1++;
        s1 = clickedValue1*c1;
      } 
      if (clickedValue1 == 10){
          c2++;
          s2 = clickedValue1*c2;
      }
      if (clickedValue1 == 20){
        c3++;
        s3 = clickedValue1*c3;
      }
      if (clickedValue1 == 50){
        c4++;
        s4 = clickedValue1*c4;
      }
      if (clickedValue1 == 100){
        c5++;
        s5 = clickedValue1*c5;
      }
    });
  });

  document.getElementById("table").addEventListener("click", function() {
    document.getElementById("secondTable").style.display = "block";
  });
  
  
  window.price1 = function() {
    var x1 = s1+s2+s3+s4+s5;
    pricing[0].arr1.push({ value: x1 });
    document.getElementById("t1").textContent = x1;
  }
  window.price2 = function() {
    var x2 = s1+s2+s3+s4+s5;
    pricing[1].arr2.push({ value: x2 });
    document.getElementById("t2").textContent = x2;
  }
  window.price5 = function() {
    var x5 = s1+s2+s3+s4+s5;
    pricing[2].arr5.push({ value: x5 });
    document.getElementById("t5").textContent = x5;
  }
  window.price10 = function() {
    var x10 = s1+s2+s3+s4+s5;
    pricing[3].arr10.push({ value: x10 });
    document.getElementById("t10").textContent = x10;
  }
  window.price20 = function() {
    var x20 = s1+s2+s3+s4+s5;
    pricing[4].arr20.push({ value: x20 });
    document.getElementById("t20").textContent = x20;
  }
  window.price40 = function() {
    var x40 = s1+s2+s3+s4+s5;
    pricing[5].arr40.push({ value: x40 });
    document.getElementById("t40").textContent = x40;
  }
  
})();