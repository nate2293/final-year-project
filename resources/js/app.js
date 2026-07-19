import "./bootstrap";
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [
                dayGridPlugin,
                timeGridPlugin,
                interactionPlugin,
            ],

            initialView: "dayGridMonth",

            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },

            events: "/calendar/events",

            eventDidMount: function (info) {
                tippy(info.el, {
                    allowHTML: true,

                    content: `
                        <div>
                            <strong>${info.event.extendedProps.type}</strong><br><br>

                            <strong>Position:</strong><br>
                            ${info.event.extendedProps.job}<br><br>

                            <strong>Company:</strong><br>
                            ${info.event.extendedProps.company}<br><br>

                            <strong>Date:</strong><br>
                            ${info.event.extendedProps.date}<br><br>

                            <strong>Notes:</strong><br>
                            ${info.event.extendedProps.notes ?? "No notes"}
                        </div>
                    `,

                    theme: "light-border",
                });
            },

            height: 650,
        });

        calendar.render();
    }
});