let scroll_btn = document.querySelector(".scroll-top");
window.addEventListener("scroll", () => {
  if (window.scrollY > 200) {
    scroll_btn.classList.add("active");
  } else {
    scroll_btn.classList.remove("active");
  }
});

scroll_btn.addEventListener("click", () => {
  document.documentElement.scrollIntoView({
    behavior: "smooth",
  });
});

async function fetchMatch() {
  let match_by_date = document.querySelector("#match-date");
  let match_by_group = document.querySelector("#match-group");
  let all_match = [];

  // Fetch data from PHP file
  let response = await fetch("hockey.php");
  let data = await response.json();

  function randerDom(match, selector) {
    selector.innerHTML += `
        <div class="match">
        <div class="match-info">
            <h4 class="group">${match.group}</h4>
            <h4>Match Number<span class="badge">${match.matchNumber}</span> </h4>
        </div>
        <div class="flags">
            <div class="home-flag">
                <img src="${match.home_flag}" alt="${match.home_team}" class="flag" />
            <h3 class="home-team">${match.home_team}</h3>
            </div>
            <span class="vs">
            VS
            </span>
            <div class="away-flag">
            <img src="${match.away_flag}" alt="${match.away_team}" class="flag" />
            <h3 class="home-team">${match.away_team}</h3>
            </div>
        </div>
        <div class="time-area">
            <div class="time">
                <h4 class="month">${match.month}</h4>
                <h4 class="day">${match.day}</h4>
                <h4 class="date">${match.date}</h4>
            </div>
            <h4 class="match-time">${match.localTime}</h4>
        </div>
     </div>
  `;
  }

  // Assuming 'data' contains the JSON array returned by fetchMatch.php
  for (let i = 0; i < data.length; i++) {
    let match = data[i];
    let time = data[i]["time"] ? new Date(data[i]["time"]) : new Date(); // Use current time if 'time' is missing or undefined
    let localTime = time.toLocaleTimeString().replace(":00:00", ":00");
    let day = match.day;
    let month = match.month;
    let home_team = match.home_team;
    let home_flag = match.home_flag;
    let away_team = match.away_team;
    let away_flag = match.away_flag;
    let stadium = match.stadium;
    let group = match.group;
    let matchNumber = match.matchNumber;
    let roundNumber = match.roundNumber;
    let date = match.date;

    let Match = {
      time: localTime,
      day: day,
      month: month,
      home_team: home_team,
      home_flag: home_flag,
      away_team: away_team,
      away_flag: away_flag,
      stadium: stadium,
      group: group,
      matchNumber: matchNumber,
      roundNumber: roundNumber,
      date: date,
    };

    all_match.push(Match);
    randerDom(Match, match_by_date);
  }

  function fBg(group) {
    return all_match.filter((g) => {
      return g.group.includes(group);
    });
  }
  let filter_by_group = [
    ...fBg("Group A"),
    ...fBg("Group B"),
    ...fBg("Group C"),
    ...fBg("Group D"),
    ...fBg("Group E"),
    ...fBg("Group F"),
    ...fBg("Group G"),
    ...fBg("Group H"),
  ];
  for (let j = 0; j < filter_by_group.length; j++) {
    randerDom(filter_by_group[j], match_by_group);
  }
}
fetchMatch();
