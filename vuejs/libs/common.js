export function convertDateVn(dateString) {
    if (!dateString) {
        return '';
    }
    const date = new Date(dateString);
    return date.toLocaleDateString("en-GB");
}
