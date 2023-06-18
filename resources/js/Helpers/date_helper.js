export default {
    methods: {
        khmerDateFormat(date) {
            let newDate = new Date(date);
            newDate.setTime(newDate.getTime() + (7 * 60 * 60 * 1000));
            const day = newDate.getDate();
            const month = newDate.getMonth();
            const year = newDate.getFullYear();

            return `ថ្ងៃទី ${this.formatDateNumber(day)} ខែ ${this.getKhmerMonth(month)} ឆ្នាំ ${year}`;
        },
        shortKhmerDateFormat(date) {
            const newDate = new Date(date);
            const day = newDate.getDate();
            const month = newDate.getMonth();
            const year = newDate.getFullYear();
            const minute = newDate.getMinutes();
            const hour = newDate.getHours();
            const amPm = hour >= 12 ? 'ល្ងាច' : 'ព្រឹក';

            return `${this.formatDateNumber(day)}-${this.getKhmerMonth(month)}-${year} | ${this.formatDateNumber(hour % 12)}:${this.formatDateNumber(minute)} ${amPm}`;
        },
        formatDateNumber(value) {
            return value.toString().padStart(2, '0');
        },
        getKhmerMonth(month) {
            const newMonth = `${month + 1}`;
            switch (newMonth) {
                case "1":
                    return "មករា";
                case "2":
                    return "កុម្ភៈ";
                case "3":
                    return "មីនា";
                case "4":
                    return "មេសា";
                case "5":
                    return "ឧសភា";
                case "6":
                    return "មិថុនា";
                case "7":
                    return "កក្កដា";
                case "8":
                    return "សីហា";
                case "9":
                    return "កញ្ញា";
                case "10":
                    return "តុលា";
                case "11":
                    return "វិច្ឆិកា";
                case "12":
                    return "ធ្នូ";
            }
            return "";
        },
        toYmdDate(date) {
            const month = this.pad2(date.getMonth() + 1);//months (0-11)
            const day = this.pad2(date.getDate());//day (1-31)
            const year = date.getFullYear();

            return year + "-" + month + "-" + day;
        },
        pad2(n) {
            return (n < 10 ? '0' : '') + n;
        },
        humanDate(dateTime) {
            dateTime = new Date(dateTime);
            dateTime.setTime(dateTime.getTime() + (7 * 60 * 60 * 1000));
            const hdate = require('human-date');
            let result = hdate.relativeTime(dateTime);
            result = result.replace("seconds", "វិនាទី");
            result = result.replace("second", "វិនាទី");
            result = result.replace("minutes", "នាទី");
            result = result.replace("minute", "នាទី");
            result = result.replace("hours", "ម៉ោង");
            result = result.replace("hour", "ម៉ោង");
            result = result.replace("days", "ថ្ងៃ");
            result = result.replace("day", "ថ្ងៃ");
            result = result.replace("weeks", "សប្តាហ៍");
            result = result.replace("week", "សប្តាហ៍");
            result = result.replace("months", "ខែ");
            result = result.replace("month", "ខែ");
            result = result.replace("years", "ឆ្នាំ");
            result = result.replace("year", "ឆ្នាំ");
            result = result.replace(" ago", "មុន");
            return result;
        }

    }
}
