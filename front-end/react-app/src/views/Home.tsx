import { useState } from 'react'
import axios from 'axios'

function Home() {
  const [people, setPeople] = useState('')
  const [cards, setCards] = useState<string[]>([])
  const [error, setError] = useState('')
  const [loading, setLoading] = useState(false)

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    setCards([])

    const n = parseInt(people)

    if (isNaN(n) || n <= 0) {
      setError('Please enter a valid number greater than 0.')
      return
    }

    setLoading(true)

    try {
      const response = await axios.post('/api/cards', {
        people: n
      })
      setCards(response.data.output)
    } 
    catch (err: any) {
      setError(err.response?.data?.message || 'Irregularity occurred.')
    }
    finally {
      setLoading(false)
    }
  }

  return (
    <div className="p-4 max-w-md mx-auto">
      <h1 className="text-xl font-bold mb-4">Card Distributor</h1>

      <form onSubmit={handleSubmit} className="space-y-4">
        <div>
          <label htmlFor="people" className="block text-sm font-medium">
            Number of People:
          </label>
          <input
            value={people}
            onChange={(e) => setPeople(e.target.value)}
            type="number"
            id="people"
            className="w-full border p-2 rounded focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
            placeholder="Enter a number (e.g. 4)"
          />
        </div>

        {error && (
          <div className="text-red-500 text-sm">
            {error}
          </div>
        )}

        <button
          type="submit"
          className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          disabled={loading}
        >
          {loading ? 'Distributing...' : 'Distribute Cards'}
        </button>
      </form>

      {cards.length > 0 && (
        <div className="mt-6">
          <h2 className="text-lg font-semibold mb-2">Result:</h2>
          <div className="space-y-2">
            {cards.map((line, index) => (
              <div
                key={index}
                className="font-mono bg-gray-100 p-2 rounded"
              >
                {line}
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  )
}

export default Home
